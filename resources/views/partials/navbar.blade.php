<nav class="navbar navbar-expand-lg bg-body-tertiary pb-0 border">
    <div class="container-fluid container-md d-block pt-2">
        <h6 class="mb-4">
            @if (auth()->user()->hasRole('admin'))
                <span class="fw-normal">Admin</span>
            @elseif (auth()->user()->hasRole('koordinator program studi'))
                <span class="fw-normal">{{ auth()->user()->jurusan->nama }} |</span>
                <span class="fw-bold">{{ (auth()->user()->kaprodi->jenjang_pendidikan . ' ' . auth()->user()->kaprodi->nama) ?? '' }}</span>
            @endif
        </h6>

        @yield('breadcrumb')

        <div class="d-flex justify-content-end mt-4">
            @if(!auth()->user()->hasRole('admin') && (!Route::is('kaprodi.kurikulum.create') && !Route::is('kaprodi.kurikulum.index') && !Route::is('kaprodi.kurikulum.edit')))
                @if(isset($kurikulum) && !$kurikulum->status->is(\App\Enums\StatusKurikulum::Aktif))
                    @if(auth()->user()->hasRole('koordinator program studi') && $kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
                        <button type="button" class="btn btn-outline-success mb-0 me-3" data-bs-toggle="modal" data-bs-target="#confirmFinalisasiModal">Finalisasi Kurikulum</button>
                    @endif
                @endif
                @if(!Route::is('dosen.mata-kuliah.index'))
                    <h3 class="mb-0">
                        <span
                            class="badge @if ($kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan)) text-bg-warning @else text-bg-success @endif rounded-bottom-0">
                            Status Kurikulum: {{ $kurikulum->status }}
                        </span>
                    </h3>
                @endif
            @endif
        </div>

        @if (auth()->user()->hasRole('koordinator program studi') && ((!Route::is('kaprodi.kurikulum.create') && !Route::is('kaprodi.kurikulum.index'))))
            {{-- Confirm modal --}}
            <div class="modal fade" id="confirmFinalisasiModal" data-bs-backdrop="static" data-bs-keyboard="false"
                 aria-hidden="true" aria-labelledby="confirmFinalisasiModalLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="confirmFinalisasiModalLabel">Konfirmasi Finalisasi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-4">
                            <div class="text-center">
                                <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                                <div>Anda yakin ingin mengfinalisasi kurikulum?</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col">
                                    <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Tidak</button>
                                </div>
                                @if(isset($kurikulum))
                                    <div class="col">
                                        <form action="{{ route('kaprodi.kurikulum.finalize', ['kurikulum' => $kurikulum->id]) }}"
                                              method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success mb-0 w-100">Finalisasi</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</nav>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.nav-link').click(function () {
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endpush
