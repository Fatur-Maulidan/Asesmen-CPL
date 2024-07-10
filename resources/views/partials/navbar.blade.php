<nav class="navbar navbar-expand-lg bg-body-tertiary pb-0 border">
    <div class="container-fluid container-md d-block pt-2">
        <h6 class="mb-4">
            @if (auth()->user()->hasRole('admin'))
                <span class="fw-normal">Admin</span>
            @else
                <span class="fw-normal">Jurusan Teknik Komputer dan Informatika |</span>
                <span class="fw-bold">D3 Teknik Informatika</span>
            @endif
        </h6>

        @yield('breadcrumb')

        <div class="my-4"></div>
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
