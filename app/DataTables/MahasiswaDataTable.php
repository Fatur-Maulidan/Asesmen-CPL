<?php

namespace App\DataTables;

use App\Enums\StatusKeaktifan;
use App\Models\Mahasiswa;
use \Illuminate\Support\Facades\Route;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MahasiswaDataTable extends DataTable
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
            ->addColumn('status', function (Mahasiswa $mhs) {
                if ($mhs->status->is(StatusKeaktifan::Aktif)) {
                    $button = '<button type="submit" class="btn btn-danger">Nonaktifkan</button>';
                } else {
                    $button = '<button type="submit" class="btn btn-success">Aktifkan</button>';
                }

                $form = '<form action="' . $this->getRoute($mhs->nim, $this->kurikulum) . '" method="post">
                    ' . csrf_field() . '
                    ' . method_field('patch') . '
                    ' . $button . '
                </form>';

                return $form;
            })
            ->addColumn('tindakan', function (Mahasiswa $mhs) {
                $content = '<a href="#" class="btn-ubah" data-bs-toggle="modal" data-bs-target="#ubahMahasiswaModal" data-nim="' . $mhs->nim . '">Ubah</a>
                <a href="#" class="btn-hapus" data-bs-toggle="modal" data-bs-target="#hapusMahasiswaModal" data-nim="' . $mhs->nim . '">Hapus</a>';

                return $content;
            })
            ->rawColumns(['status', 'tindakan']);
        // ->addColumn('action', 'mahasiswa.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Mahasiswa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Mahasiswa $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('mahasiswa-table')
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
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('nim')->title('NIM'),
            Column::make('nama'),
            Column::make('email'),
            Column::make('kelas'),
            Column::make('jenis_kelamin'),
            Column::make('tahun_angkatan'),
            Column::make('status'),
            Column::make('tindakan'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Mahasiswa_' . date('YmdHis');
    }

    private function getRoute($nim, $kurikulum)
    {
        if (Route::is('admin.mahasiswa.*')) {
            $route = route('admin.mahasiswa.toggleStatus', ['mahasiswa' => $nim]);
        } else if (Route::is('kaprodi.mahasiswa.*')) {
            $route = route('kaprodi.mahasiswa.toggleStatus', ['kurikulum' => $kurikulum, 'mahasiswa' => $nim]);
        }

        return $route;
    }
}
