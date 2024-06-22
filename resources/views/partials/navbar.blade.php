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
                {{-- <li class="nav-item"> --}}
                {{--    <a class="nav-link @if (Route::is('admin.mahasiswa.*')) active @endif" --}}
                {{--       href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a> --}}
                {{-- </li> --}}
            </ul>
        @elseif($role == 'Koordinator Program Studi')
            <ul class="nav nav-underline mt-4">
                @if (Route::is('kaprodi.kurikulum.*') && !Route::is('kaprodi.kurikulum.dashboard.*'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('kaprodi.kurikulum.index') }}">Kurikulum</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.kurikulum.dashboard.*')) active @endif" href="{{ route('kaprodi.kurikulum.dashboard.cpl', ['kurikulum' => $kurikulum->tahun]) }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.cpl.*')) active @endif"
                            href="{{ route('kaprodi.cpl.index', ['kurikulum' => $kurikulum->tahun]) }}">Capaian
                            Pembelajaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.ik.*')) active @endif"
                            href="{{ route('kaprodi.ik.index', ['kurikulum' => $kurikulum->tahun]) }}">Indikator
                            Kinerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.tp.*')) active @endif"
                            href="{{ route('kaprodi.tp.index', ['kurikulum' => $kurikulum->tahun]) }}">Tujuan
                            Pembelajaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.mata-kuliah.*')) active @endif"
                            href="{{ route('kaprodi.mata-kuliah.index', ['kurikulum' => $kurikulum->tahun]) }}">Mata
                            Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.mahasiswa.*')) active @endif"
                            href="{{ route('kaprodi.mahasiswa.index', ['kurikulum' => $kurikulum->tahun]) }}">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.dosen.*')) active @endif"
                            href="{{ route('kaprodi.dosen.index', ['kurikulum' => $kurikulum->tahun]) }}">Dosen</a>
                    </li>
                    <li class="nav-item ms-auto align-self-end">
                        <h3 class="mb-0"><span class="badge text-bg-success rounded-bottom-0">{{ $kurikulum->status }}</span></h3>
                    </li>
                @endif
            </ul>
        @else
            <ul class="nav nav-underline">
                @if (Route::is('dosen.mata-kuliah.index'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dosen.mata-kuliah.index') }}">Mata Kuliah</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('dosen.mata-kuliah.dashboard')) active @endif" href="{{ route('dosen.mata-kuliah.dashboard', ['kodeMataKuliah' => $mata_kuliah->kode]) }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('dosen.mata-kuliah.show')) active @endif"
                           href="{{ route('dosen.mata-kuliah.show', ['kodeMataKuliah' => $mata_kuliah->kode]) }}">Informasi Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('dosen.mata-kuliah.indikator-kinerja.*')) active @endif"
                           href="{{ route('dosen.mata-kuliah.indikator-kinerja.index', ['kodeMataKuliah' => $mata_kuliah->kode]) }}">Indikator
                            Kinerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.tp.*')) active @endif"
                           href="{{ route('dosen.mata-kuliah.tujuan-pembelajaran', ['kodeMataKuliah' => $mata_kuliah->kode]) }}">Tujuan
                            Pembelajaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.mata-kuliah.*')) active @endif"
                           href="{{ route('dosen.mata-kuliah.rencana-asesmen', ['kodeMataKuliah' => $mata_kuliah->kode]) }}">Rencana Asesmen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('kaprodi.mahasiswa.*')) active @endif"
                           href="{{ route('dosen.mata-kuliah.nilai-mahasiswa', ['kodeMataKuliah' => $mata_kuliah->kode]) }}">Nilai Mahasiswa</a>
                    </li>

                    <li class="nav-item ms-auto align-self-end">
                        <h3 class="mb-0"><span class="badge text-bg-success rounded-bottom-0">{{ $kurikulum->status }}</span></h3>
                    </li>
                @endif
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
