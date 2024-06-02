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

        @if ($role == 'Admin')
            <ul class="nav nav-underline mt-4">
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('admin.dashboard.*')) active @endif"
                        href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('admin.jurusan.*')) active @endif"
                        href="{{ route('admin.jurusan.index') }}">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('admin.dosen.*')) active @endif"
                        href="{{ route('admin.dosen.index') }}">Dosen</a>
                </li>
            </ul>
        @elseif($role == 'Koordinator Program Studi')
            <ul class="nav nav-underline mt-4">
                @if (Route::is('kaprodi.kurikulum.*') && !Route::is('kaprodi.kurikulum.dashboard'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('kaprodi.kurikulum.index') }}">Kurikulum</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link @if (url()->current() == route('kaprodi.kurikulum.dashboard', ['kurikulum' => $kurikulum])) active @endif"
                            href="{{ route('kaprodi.kurikulum.dashboard', ['kurikulum' => $kurikulum]) }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.cpl.*')) active @endif"
                            href="{{ route('kaprodi.cpl.index', ['kurikulum' => $kurikulum]) }}">Capaian
                            Pembelajaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.ik.*')) active @endif"
                            href="{{ route('kaprodi.ik.index', ['kurikulum' => $kurikulum]) }}">Indikator Kinerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.tp.*')) active @endif"
                            href="{{ route('kaprodi.tp.index', ['kurikulum' => $kurikulum]) }}">Tujuan Pembelajaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.mk.*')) active @endif"
                            href="{{ route('kaprodi.mk.index', ['kurikulum' => $kurikulum]) }}">Mata Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.mahasiswa.*')) active @endif"
                            href="{{ route('kaprodi.mahasiswa.index', ['kurikulum' => $kurikulum]) }}">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.dosen.*')) active @endif"
                            href="{{ route('kaprodi.dosen.index', ['kurikulum' => $kurikulum]) }}">Dosen</a>
                    </li>
                    <li class="nav-item ms-auto align-self-end">
                        <h3 class="mb-0"><span class="badge text-bg-warning rounded-bottom-0">Peninjauan</span></h3>
                    </li>
                @endif
            </ul>
        @else
            <ul class="nav nav-underline">
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
                            href="{{ $nav['link'] != '#'
                                ? (isset($nav['parameters'])
                                    ? route($nav['link'], ['kodeMataKuliah' => $kodeMataKuliah, 'id' => $id])
                                    : route($nav['link'], ['kodeMataKuliah' => $kodeMataKuliah]))
                                : '#' }}">
                            {{ $nav['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
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
