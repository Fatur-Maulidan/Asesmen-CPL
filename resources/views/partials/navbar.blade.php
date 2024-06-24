<nav class="navbar navbar-expand-lg bg-body-tertiary pb-0 border">
    <div class="container-fluid container-md d-block pt-2">
        <h6 class="mb-4">
            @if ($role == 'Admin')
                <span class="fw-normal">Admin</span>
            @else
                <span class="fw-normal">Jurusan Teknik Komputer dan Informatika |</span>
                <span class="fw-bold">D3 Teknik Informatika</span>
            @endif
        </h6>

        @yield('breadcrumb')

{{--        @if($role != 'Admin' && (!Route::is('kaprodi.kurikulum.create') && !Route::is('kaprodi.kurikulum.index')))--}}
{{--            <div class="mt-4">--}}
{{--                <h3 class="mb-0 text-end">--}}
{{--                <span class="badge text-bg-success rounded-bottom-0">--}}
{{--                    Kurikulum {{ $kurikulum->status }}--}}
{{--                </span>--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--        @endif--}}
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
