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
                    @if ($index == 0)
                        <a class="nav-link active me-2">{{ $nav }}</a>
                    @else
                        <a class="nav-link me-2">{{ $nav }}</a>
                    @endif
                @endforeach
                {{-- <a class="nav-link active" aria-current="page" href="{{ route('kurikulum.index') }}">Kurikulum</a> --}}
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li> --}}
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
