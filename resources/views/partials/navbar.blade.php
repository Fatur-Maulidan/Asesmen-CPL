<nav class="navbar navbar-expand-lg bg-body-tertiary pb-0 border">
    <div class="container-fluid container-md d-block pt-2">
        <h6 class="mb-4">
            @if (auth()->user()->roles[0]->name == 'admin')
                <span class="fw-normal">Admin</span>
            @else
                <span class="fw-normal">Jurusan Teknik Komputer dan Informatika |</span>
                <span class="fw-bold">D3 Teknik Informatika</span>
            @endif
        </h6>

        @yield('breadcrumb')

        @if(auth()->user()->roles[0]->name != 'Admin' && (!Route::is('kaprodi.kurikulum.create') && !Route::is('kaprodi.kurikulum.index')))
            @if(isset($kurikulum) && !$kurikulum->status->is(\App\Enums\StatusKurikulum::Aktif))
                <div class="d-flex justify-content-end mt-4">
                    @if(auth()->user()->roles[0]->name == 'koordinator program studi' && $kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
                        <button type="button" class="btn btn-outline-success mb-0 me-3" data-bs-toggle="modal" data-bs-target="#confirmFinalisasiModal">Finalisasi</button>
                    @endif
                    <h3 class="mb-0">
                <span
                    class="badge @if ($kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan)) text-bg-warning @else text-bg-primary) @endif rounded-bottom-0">
                    {{ $kurikulum->status }}
                </span>
                    </h3>
                </div>
            @endif
        @endif

        @if (auth()->user()->roles[0]->name == 'koordinator program studi' && isset($kurikulum))
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
                                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Tidak
                                </button>
                            </div>
                            <div class="col">
                                <form action="{{ route('kaprodi.kurikulum.update', ['kurikulum' => $kurikulum->id]) }}"
                                      method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ \App\Enums\StatusKurikulum::Aktif }}">
                                    <button type="submit" class="btn btn-success mb-0 w-100">Finalisasi</button>
                                </form>
                            </div>
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
