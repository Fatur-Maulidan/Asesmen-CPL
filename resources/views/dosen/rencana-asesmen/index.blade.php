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
        <table class="table">
            <thead>
                <tr class="text-center align-middle">
                    <th scope="col">Tujuan Pembelajaran</th>
                    @for ($i = 1; $i <= 8; $i++)
                        <th scope="col"><a
                                href="{{ route('mata-kuliah.rencana-asesmen.detail-informasi') }}">{{ 'Tugas#' . $i }}</a>
                        </th>
                    @endfor
                    @for ($i = 1; $i <= 2; $i++)
                        <th scope="col"><a
                                href="{{ route('mata-kuliah.rencana-asesmen.detail-informasi') }}">{{ 'Tugas#' . $i }}</a>
                        </th>
                    @endfor
                    <th scope="col"><a href="{{ route('mata-kuliah.rencana-asesmen.detail-informasi') }}">Tugas Besar</a>
                    </th>
                    <th scope="col"><a href="{{ route('mata-kuliah.rencana-asesmen.detail-informasi') }}">UTS</a></th>
                    <th scope="col"><a href="{{ route('mata-kuliah.rencana-asesmen.detail-informasi') }}">UAS</a></th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 11; $i++)
                    <tr>
                        <td scope="row" class="text-center">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header" id="heading{{ $i }}">
                                        <button class="btn border-0" style="padding: 0 !important;" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}"
                                            aria-expanded="false" aria-controls="collapse{{ $i }}">
                                            {{ 'TP-' . $i }}
                                        </button>
                                    </h2>
                                </div>
                            </div>
                        </td>
                        @for ($j = 1; $j <= 13; $j++)
                            <td class="text-center align-middle"><input type="checkbox"></td>
                        @endfor
                    </tr>
                    <tr>
                        <td colspan="14" class="p-0">
                            <div id="collapse{{ $i }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body px-3 py-4">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis quasi totam
                                    explicabo consequuntur dolore? Quam cupiditate harum, quasi, aperiam ratione eos aut
                                    eligendi, consequatur saepe libero consectetur a ex numquam.
                                </div>
                            </div>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
@endpush
