<nav class="navbar navbar-expand-lg bg-body-tertiary pb-0 border">
    <div class="container-fluid container-md d-block pt-2">
        <h6 class="mb-4">
            <span class="fw-normal">Jurusan Teknik Komputer dan Informatika |</span>
            <span class="fw-bold">D3 Teknik Informatika</span>
        </h6>

        @yield('breadcrumb')

        <ul class="nav nav-underline mt-4">
            @if (Route::is('kurikulum.*') && !Route::is('kurikulum.dashboard'))
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('kurikulum.index') }}">Kurikulum</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link @if (url()->current() == route('kurikulum.dashboard', ['kurikulum' => 2022])) active @endif"
                        href="{{ route('kurikulum.dashboard', ['kurikulum' => 2022]) }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('cpl.*')) active @endif"
                        href="{{ route('cpl.index', ['kurikulum' => 2022]) }}">Capaian Pembelajaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('ik.*')) active @endif"
                        href="{{ route('ik.index', ['kurikulum' => 2022]) }}">Indikator Kinerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('tp.*')) active @endif"
                        href="{{ route('tp.index', ['kurikulum' => 2022]) }}">Tujuan Pembelajaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('mk.*')) active @endif"
                        href="{{ route('mk.index', ['kurikulum' => 2022]) }}">Mata Kuliah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Dosen</a>
                </li>
                <li class="nav-item ms-auto align-self-end">
                    <h3 class="mb-0"><span class="badge text-bg-warning rounded-bottom-0">Peninjauan</span></h3>
                </li>
            @endif
        </ul>

        {{-- <ul class="nav nav-underline">
            <?php $navbar = isNavbarRole($role); ?>
            @foreach ($navbar as $index => $nav)
                <li class="nav-item d-flex flex-row">
                    <?php
                    $isActive = Route::is($nav['link']);
                    if (isset($nav['child_links'])) {
                        foreach ($nav['child_links'] as $childNav) {
                            if (Route::is($childNav['link'])) {
                                $isActive = true;
                            }
                        }
                    }
                    ?>
                    <a class="nav-link {{ $isActive ? 'active' : '' }} me-3"
                        href="{{ $nav['link'] != '#' ? route($nav['link']) : '#' }}">{{ $nav['title'] }}</a>
                </li>
            @endforeach
        </ul> --}}
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
