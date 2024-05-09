<div class="modal fade" id="addProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content me-5" style="width: 700px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('addData') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Id Produk</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control-plaintext" id="id" name="id"
                                value="{{$id}}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Nama Produk</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="namaProduk" name="nama_produk"
                                value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Gambar</label>
                        <div class="col-sm-7">
                            <input class="form-control " type="file" accept=".png, .jpg, .jpeg" id="gambarProduk"
                                name="gambar_produk" onchange="previewImg()">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Harga Produk</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="hargaProduk" name="harga_produk"
                                value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Kategori</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="kategori" id="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="Pakaian & Celana">Pakaian & Celana</option>
                                <option value="Peralatan Outdoor">Peralatan Outdoor</option>
                                <option value="Peralatan Keamanan">Peralatan Keamanan</option>
                                <option value="Sepatu & Sandal">Sepatu & Sandal</option>
                                <option value="Ransel">Ransel</option>
                                <option value="Jaket & Jas Hujan">Jaket & Jas Hujan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Deskripsi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">merk</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="merk" id="merk">
                                <option value="">Pilih Merk</option>
                                <option value="Consina">Consina</option>
                                <option value="Forester">Forester</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Ketinggian</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="ketinggian" id="ketinggian">
                                <option value="">Pilih Ketinggian</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Kesulitan</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="kesulitan" id="kesulitan">
                                <option value="">Pilih Kesulitan</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                            </select>
                        </div>
                    </div>
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Lama Pendakian</label>
                    <div class="col-sm-7">
                        <select type="text" class="form-control" name="lama_pendakian" id="lama_pendakian">
                            <option value="">Pilih Lama Pendakian</option>
                            <option value="Pendek">Pendek</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Panjang">Panjang</option>
                        </select>
                    </div>
            </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Suhu</label>
            <div class="col-sm-7">
                <select type="text" class="form-control" name="suhu" id="suhu">
                    <option value="">Pilih Suhu</option>
                    <option value="Dingin">Dingin</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Hangat">Hangat</option>
                </select>
            </div>
        </div>


                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save </button>
                </div>
            </form>
        </div>
    </div>
</div>
