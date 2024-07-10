@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.indikator-kinerja.index', $mata_kuliah->kode, $mata_kuliah->mataKuliahRegister[0]->jenis) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    <div class="border border-1 overflow-auto">
        <table class="table table-condensed">
            <thead>
                <tr class="text-center align-middle">
                    <th scope="col">Nim</th>
                    <th scope="col">Nama Mahasiswa</th>
                    @foreach ($mata_kuliah->mataKuliahRegister[0]->rencanaAsesmen as $index => $rencanaAsesmen)
                        <th scope="col">
                            <button type="button" class="btn btn-primary border-0" id="button-{{ $index }}"
                                onclick="enableInput({{ $index }})">Ubah Nilai</button>
                            <div class="">
                                {{ $rencanaAsesmen->kode }}
                            </div>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($mata_kuliah->mataKuliahRegister[0]->mahasiswa as $mhs)
                    <tr>
                        <td scope="col">{{ $mhs->nim }}</td>
                        <td scope="col">{{ $mhs->nama }}</td>
                        @foreach ($mata_kuliah->mataKuliahRegister[0]->rencanaAsesmen as $index => $rencanaAsesmen)
                            @foreach ($rencanaAsesmen->mahasiswa as $nilaiMhs)
                                @if ($nilaiMhs->nim == $mhs->nim)
                                    <td class="text-center align-middle">
                                        <form id="form-{{ $index }}-{{ $mhs->nim }}" method="POST"
                                            action="{{ route('dosen.mata-kuliah.nilai-mahasiswa.update', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $jenis, 'nim' => $mhs->nim, 'rencanaAsesmen' => $rencanaAsesmen->id]) }}">
                                            @csrf
                                            <input class="text-center nilai-input" type="text" id="nilai"
                                                name="nilai" value="{{ $nilaiMhs->pivot->nilai }}" style="width: 40px"
                                                disabled>
                                        </form>
                                    </td>
                                @endif
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        function enableInput(columnIndex) {
            var button = document.getElementById('button-' + columnIndex);
            if (button.textContent === 'Ubah Nilai') {
                button.textContent = 'Simpan';
                var rows = document.querySelectorAll('tbody tr');
                rows.forEach(function(row) {
                    var inputs = row.querySelectorAll('td input');
                    var input = inputs[columnIndex];
                    console.log('Enabling input:', input); // Debugging line
                    input.disabled = false;
                    input.focus();
                });
            } else {
                var rows = document.querySelectorAll('tbody tr');
                rows.forEach(function(row) {
                    var inputs = row.querySelectorAll('td input');
                    var input = inputs[columnIndex];
                    var form = input.closest('form');
                    console.log('Submitting form:', form); // Debugging line
                    form.submit();
                });
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            let nilaiInputs = document.querySelectorAll('.nilai-input');
            nilaiInputs.forEach(function(input) {
                validateInput(input);
            });
        });

        function validateInput(inputElement) {
            inputElement.addEventListener('input', function() {
                let value = inputElement.value;
                if (value >= 0 && value <= 100) {
                    inputElement.value = value;
                } else {
                    inputElement.value = value.slice(0, -1);
                }
            });
        }
    </script>
@endpush
