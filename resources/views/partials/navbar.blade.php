<nav class="navbar navbar-expand-lg bg-body-tertiary pb-0 border">
    <div class="container-fluid container-md d-block pt-2">
        <h6 class="mb-4">
            <span class="fw-normal">Jurusan Teknik Komputer dan Informatika |</span>
            <span class="fw-bold">D3 Teknik Informatika</span>
        </h6>

        @yield('breadcrumb')

        <ul class="nav nav-underline">
            <li class="nav-item d-flex flex-row">
                <?php $navbar = isNavbarRole($role); ?>
                @foreach ($navbar as $index => $nav)
                    <a class="nav-link {{ $index == 0 ? 'active' : '' }} me-2"
                        href="{{ $nav['link'] ?? '#' }}">{{ $nav['title'] }}</a>
                @endforeach
        </ul>
    </div>
</nav>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.nav-link').click(function() {
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endpush
