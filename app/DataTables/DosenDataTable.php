<?php

namespace App\DataTables;

use App\Enums\RoleDosen;
use App\Enums\StatusKeaktifan;
use App\Enums\StatusKurikulum;
use App\Models\Master_04_Dosen;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DosenDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            // ->addColumn('action', 'dosen.action');
            ->addColumn('jurusan', function (Master_04_Dosen $dosen) {
                return $dosen->jurusan->nama ?? '';
            })
            ->addColumn('program_studi', function (Master_04_Dosen $dosen) {
                $prodi_dosen = '';
                foreach ($dosen->programStudi as $prodi) {
                    $prodi_dosen .= '<li>' . $prodi->jenjang_pendidikan . ' ' . $prodi->nama . '</li>';
                }

                return '<ul class="mb-0 p-0">' . $prodi_dosen . '</ul>';
            })
            ->addColumn('status', function (Master_04_Dosen $dosen) {
                if ($dosen->status->is(StatusKeaktifan::Aktif)) {
                    $button = '<button type="submit" class="btn btn-danger">Nonaktifkan</button>';
                } else {
                    $button = '<button type="submit" class="btn btn-success">Aktifkan</button>';
                }

                $route = '';
                if (Auth::user()->hasRole('admin')) {
                    $route = route('admin.dosen.toggleStatus', ['dosen' => $dosen->id]);
                } else if (Auth::user()->hasRole('koordinator program studi')) {
                    $route = route('kaprodi.dosen.toggleStatus', ['kurikulum' => $this->kurikulum->tahun, 'dosen'
                    => $dosen->id]);
                }

                $form = '<form action="' . $route . '" method="post">
                    ' . csrf_field() . '
                    ' . method_field('PATCH') . '
                    ' . $button . '
                </form>';

                return $form;
            })
            ->addColumn('tindakan', function (Master_04_Dosen $dosen) {
                $content = '<button type="button" class="btn btn-warning btn-ubah" data-bs-toggle="modal" data-bs-target="#DosenModal" data-id="' . $dosen->id . '">Ubah</button>';

                return $content;
            })
            ->rawColumns(['program_studi', 'status', 'tindakan']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Master_04_Dosen $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Master_04_Dosen $model)
    {
        $query = $model->newQuery()->role('dosen');

        if ($this->kaprodi) {
            $query->where('01_MASTER_jurusan_id', $this->jurusan_id);
        }

        if ($this->filter) {
            if ($this->filter['jurusan']) {
                $query->where('01_MASTER_jurusan_id', $this->filter['jurusan']);
            }
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('dosen-table')
            // ->selectClassName('mt-4')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            Column::make('kode'),
            Column::make('nip')->title('NIP'),
            Column::make('nama'),
            Column::make('email'),
            Column::make('jurusan'),
            Column::make('program_studi'),
            Column::make('status'),
            Column::make('tindakan'),
        ];

        if ($this->kaprodi && !$this->kurikulum->status->is(StatusKurikulum::Pengelolaan)) {
            array_pop($columns);
        }

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Dosen_' . date('YmdHis');
    }
}
