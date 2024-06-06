@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.tp.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row mb-4">
        <div class="col-12">
            <form action="" class="d-flex">
                <div class="row">
                    <div class="col-auto">
                        <select class="form-select me-3">
                            <option value="1">21IF001 - Dasar Dasar Pemrograman</option>
                            <option value="2">21IF002 - Pengantar</option>
                            <option value="3">21IF003 - Proyek 1</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select">
                            <option value="1">IK-1</option>
                            <option value="2">IK-2</option>
                            <option value="3">IK-33</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="fw-bold">21IF001 - Dasar Dasar Pemrograman</div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque voluptates quaerat atque cumque quas culpa
                reprehenderit molestiae fugiat cupiditate dicta.</p>
        </div>
        <div class="col-6">
            <div class="fw-bold">IK-1</div>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro vero iste exercitationem dignissimos
                consequuntur optio expedita ut voluptatem architecto error.</p>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Kode TP</th>
                        <th scope="col" width="45%">Deskripsi TP</th>
                        <th scope="col">Tindakan</th>
                        <th scope="col">Alasan Penolakan</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="">
                        <tr>
                            <td class="py-3 align-content-center ">TP-1</td>
                            <td class="py-3">
                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
                                    placeat
                                    aliquam
                                    mollitia, reprehenderit ratione modi minus recusandae animi fugiat eius!</p>
                            </td>
                            <td class="py-3 align-content-center ">
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="status[0]"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Tolak
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status[0]"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Setujui
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td class="align-content-center ">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" disabled
                                    placeholder="Masukkan alasan penolakan" style="resize: none"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 align-content-center ">TP-2</td>
                            <td class="py-3">
                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
                                    placeat
                                    aliquam
                                    mollitia, reprehenderit ratione modi minus recusandae animi fugiat eius!</p>
                            </td>
                            <td class="py-3 align-content-center">
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="status[1]"
                                            id="flexRadioDefault3" checked>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Tolak
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status[1]"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            Setujui
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td class="align-content-center ">
                                <textarea class="form-control" id="exampleFormControlTextarea2" placeholder="Masukkan alasan penolakan"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 align-content-center ">TP-3</td>
                            <td class="py-3">
                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
                                    placeat
                                    aliquam
                                    mollitia, reprehenderit ratione modi minus recusandae animi fugiat eius!</p>
                            </td>
                            <td class="py-3 align-content-center ">
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="status[2]"
                                            id="flexRadioDefault5">
                                        <label class="form-check-label" for="flexRadioDefault5">
                                            Tolak
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status[2]"
                                            id="flexRadioDefault6" checked>
                                        <label class="form-check-label" for="flexRadioDefault6">
                                            Setujui
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td class="align-content-center ">
                                <textarea class="form-control" id="exampleFormControlTextarea3" placeholder="Masukkan alasan penolakan"></textarea>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-outline-danger">Atur ulang</button>
            <button type="button" class="btn btn-outline-danger">Tolak semua</button>
            <button type="button" class="btn btn-outline-primary">Setujui semua</button>
            <button type="button" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-success" disabled>Finalisasi</button>
        </div>
    </div>
@endsection
