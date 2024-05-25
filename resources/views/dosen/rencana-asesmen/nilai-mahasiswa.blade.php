@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render() }}</li>
        </ol>
    </nav>
    <h1>{{ $title }}</h1>
@endsection

@section('main')
    <div class="border border-1 overflow-auto">
        <table class="table table-condensed">
            <thead>
                <tr class="text-center align-middle">
                    <th scope="col">Nim</th>
                    <th scope="col">Nama Mahasiswa</th>
                    @for ($i = 1; $i <= 8; $i++)
                        <th scope="col">
                            <button class="btn ubah-nilai border-0" onclick="enableInput({{ $i }})">Ubah
                                Nilai</button>
                            <div class="">
                                {{ 'Tugas#' . $i }}
                            </div>
                        </th>
                    @endfor
                    <th scope="col">Kuis#1</th>
                    <th scope="col">Kuis#2</th>
                    <th scope="col">Tugas Besar</th>
                    <th scope="col">UTS</th>
                    <th scope="col">UAS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $mahasiswa = mahasiswa();
                $count = countMahasiswa($mahasiswa);
                ?>
                @foreach ($mahasiswa as $mhs)
                    <tr>
                        <td scope="col">{{ $mhs['nim'] }}</td>
                        <td scope="col">{{ $mhs['nama'] }}</td>
                        @for ($j = 1; $j <= 13; $j++)
                            <td class="text-center align-middle">
                                <input class="text-center nilai-input" type="text" value="88" style="width: 40px"
                                    disabled>
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        function enableInput(columnIndex) {
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var inputs = row.querySelectorAll('td input');
                var input = inputs[columnIndex - 1];
                input.disabled = false;
                input.focus();
            });
        }
    </script>
@endpush
