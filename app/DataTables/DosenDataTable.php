<?php

namespace App\DataTables;

use App\Enums\RoleDosen;
use App\Enums\StatusKeaktifan;
use App\Models\Master_04_Dosen;
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
                return $dosen->jurusan->nama;
            })
            ->addColumn('program_studi', function (Master_04_Dosen $dosen) {
                return $dosen->programStudi->jenjang_pendidikan . ' ' . $dosen->programStudi->nama;
            })
            ->addColumn('status', function (Master_04_Dosen $dosen) {
                if ($dosen->status->is(StatusKeaktifan::Aktif)) {
                    $button = '<button type="submit" class="btn btn-danger">Nonaktifkan</button>';
                } else {
                    $button = '<button type="submit" class="btn btn-success">Aktifkan</button>';
                }

                $form = '<form action="' . route('admin.dosen.toggleStatus', ['dosen' => $dosen->nip]) . '" method="post">
                    ' . csrf_field() . '
                    ' . method_field('PATCH') . '
                    ' . $button . '
                </form>';

                return $form;
            })
            ->addColumn('tindakan', function (Master_04_Dosen $dosen) {
                $content = '<a href="#" class="btn-ubah" data-bs-toggle="modal" data-bs-target="#tambahDosenModal" data-id="' . $dosen->nip . '">Ubah</a>
                <a href="#" class="btn-hapus" data-bs-toggle="modal" data-bs-target="#hapusDosenModal" data-id="' . $dosen->nip . '">Hapus</a>';

                return $content;
            })
            ->rawColumns(['status', 'tindakan']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Master_04_Dosen $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Master_04_Dosen $model)
    {
        $query = $model->newQuery();

        if ($this->kaprodi) {
            $query->where('01_MASTER_jurusan_id', $this->jurusan_id);
        }

        if ($this->filter) {
            if ($this->filter['role']) {
                $query->where('role', $this->filter['role']);
            }

            if ($this->filter['jurusan']) {
                $query->where('01_MASTER_jurusan_id', $this->filter['jurusan']);
            }

            if ($this->filter['status']) {
                $query->where('status', $this->filter['status']);
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
        return [
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            Column::make('nip')->title('NIP'),
            Column::make('kode'),
            Column::make('nama'),
            Column::make('email'),
            Column::make('role'),
            Column::make('jurusan'),
            Column::make('program_studi'),
            Column::make('status'),
            Column::make('tindakan')
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
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
