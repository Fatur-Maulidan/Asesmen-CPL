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
                            <div>{{ $rencanaAsesmen->kode }}</div>
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
                                            <input class="text-center nilai-input" type="text"
                                                id="nilai-{{ $index }}-{{ $mhs->nim }}" name="nilai"
                                                value="{{ $nilaiMhs->pivot->nilai }}" style="width: 40px"
                                                data-column="{{ $index }}" data-nim="{{ $mhs->nim }}"
                                                data-rencana-asesmen = "{{ $rencanaAsesmen->kode }}">
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
        // $(document).ready(function() {
        //     $('.nilai-input').on('blur', function() {
        //         var input = $(this);
        //         var value = input.val();
        //         var form = input.closest('form');
        //         var columnIndex = input.data('column');

        //         // Disable input to prevent further edits
        //         input.prop('disabled', true);

        //         // AJAX request to update nilai
        //         $.ajax({
        //             url: form.attr('action'),
        //             method: 'POST',
        //             data: form.serialize(), // Serialize form data
        //             success: function(response) {
        //                 console.log('Nilai updated:', response);
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error updating nilai:', error);
        //             }
        //         });
        //     });
        // });

        $(document).ready(function() {
            $('.nilai-input').on('blur', function() {
                var input = $(this);
                var form = input.closest('form');

                // Submit form synchronously
                form.submit();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let nilaiInputs = document.querySelectorAll('.nilai-input');
            nilaiInputs.forEach(function(input) {
                validateInput(input);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let nilaiInputs = document.querySelectorAll('.nilai-input');
            nilaiInputs.forEach(function(input) {
                validateInput(input);
                input.addEventListener('focus', function() {
                    console.log('NIM:', input.getAttribute('data-nim'));
                    console.log('Rencana Asesmen Kode:', input.getAttribute(
                        'data-rencana-asesmen'));
                    console.log('Nilai:', input.value);
                });
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
