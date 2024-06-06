<div class="col-3">
    <div class="card">
        <div class="card-body">
            @foreach($daftar_mata_kuliah as $mk)
                <div class="mb-3">
                    <a href="{{ route('kaprodi.mata-kuliah.show', ['kurikulum' => $kurikulum, 'mata_kuliah' => $mk->id]) }}" class="btn btn-light w-100 text-start @if(request()->segment(count(request()->segments())) == $mk->id) active @endif">{{ $mk->kode . ' ' . $mk->nama }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
