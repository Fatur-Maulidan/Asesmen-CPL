<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid container-md ">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo-polban2.png') }}" alt="polban" width=40 class="d-inline-block me-2">
            <span class="fw-bold">Asesmen CPL Polban</span>
        </a>
        <div class="d-flex align-items-center ">
            <div class="d-flex flex-column text-end me-2">
                <div class="fw-bold">{{ $nama }}</div>
                <div>{{ $role }}</div>
            </div>
            <img src="{{ asset('images/logo-polban2.png') }}" alt="polban" width=40>
        </div>
    </div>
</nav>
