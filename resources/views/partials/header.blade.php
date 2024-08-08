<nav class="navbar navbar-expand-lg shadow shadow-sm">
    <div class="container-fluid container-md ">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo-polban2.png') }}" alt="polban" width=40 class="d-inline-block me-2">
            <span class="fw-bold">Asesmen CPL Polban</span>
        </a>
        <div class="d-flex align-items-center ">
            <div class="d-flex flex-column text-end me-2">
                <div class="fw-bold">{{ auth()->user()->nama }}</div>
                <div>{{ Str::title(auth()->user()->getRoleNames()[0]) }}</div>
            </div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger ms-3">Logout</button>
            </form>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg bg-dark shadow shadow-sm py-3" data-bs-theme="dark">
    <div class="container-fluid">
        <ul class="navbar-nav nav-underline mx-auto">
            @if (auth()->user()->hasRole('admin'))
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
            @elseif(auth()->user()->hasRole('koordinator program studi'))
                @if (Route::is('kaprodi.kurikulum.*') && !Route::is('kaprodi.kurikulum.dashboard.*'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('kaprodi.kurikulum.index') }}">Kurikulum</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.kurikulum.dashboard.*')) active @endif"
                            href="{{ route('kaprodi.kurikulum.dashboard.cpl', ['kurikulum' => $kurikulum->tahun, 'domain' => 'sikap']) }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.cpl.*')) active @endif"
                            href="{{ route('kaprodi.cpl.index', ['kurikulum' => $kurikulum->tahun]) }}">Capaian
                            Pembelajaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.dosen.*')) active @endif"
                            href="{{ route('kaprodi.dosen.index', ['kurikulum' => $kurikulum->tahun]) }}">Dosen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.mahasiswa.*')) active @endif"
                            href="{{ route('kaprodi.mahasiswa.index', ['kurikulum' => $kurikulum->tahun]) }}">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.mata-kuliah.*')) active @endif"
                            href="{{ route('kaprodi.mata-kuliah.index', ['kurikulum' => $kurikulum->tahun]) }}">Mata
                            Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.tp.*')) active @endif"
                            href="{{ route('kaprodi.tp.index', ['kurikulum' => $kurikulum->tahun]) }}">Tujuan
                            Pembelajaran</a>
                    </li>
                @endif
            @else
                @if (Route::is('dosen.mata-kuliah.index'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dosen.mata-kuliah.index') }}">Mata Kuliah yang Diampu</a>
                    </li>
                @else
                    {{--<li class="nav-item">--}}
                    {{--    <a class="nav-link @if (Route::is('dosen.mata-kuliah.dashboard')) active @endif"--}}
                    {{--        href="{{ route('dosen.mata-kuliah.dashboard', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis]) }}">Dashboard</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('dosen.mata-kuliah.show')) active @endif"
                            href="{{ route('dosen.mata-kuliah.show', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis]) }}">Informasi
                            Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('dosen.mata-kuliah.indikator-kinerja.*')) active @endif"
                            href="{{ route('dosen.mata-kuliah.indikator-kinerja.index', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis]) }}">Indikator
                            Kinerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('dosen.mata-kuliah.tujuan-pembelajaran.*')) active @endif"
                            href="{{ route('dosen.mata-kuliah.tujuan-pembelajaran', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis]) }}">Tujuan
                            Pembelajaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('dosen.mata-kuliah.rencana-asesmen.*')) active @endif"
                            href="{{ route('dosen.mata-kuliah.rencana-asesmen.index', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis]) }}">Rencana
                            Asesmen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('dosen.mata-kuliah.nilai-mahasiswa.*')) active @endif"
                            href="{{ route('dosen.mata-kuliah.nilai-mahasiswa.index', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis]) }}">Nilai
                            Mahasiswa</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</nav>
