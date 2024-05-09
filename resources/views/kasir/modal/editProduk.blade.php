<div class="modal fade" id="editProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content me-5" style="width: 700px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('updateProduk', $data->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Id Produk</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control-plaintext" id="id" name="id"
                                value="{{ $data->id }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Nama Produk</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="namaProduk" name="nama_produk"
                                value="{{ $data->nama_produk }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Gambar</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="gambar_produk" value="{{ $data->gambar_produk }}">
                            <img src="{{ asset('storage/produk/' . $data->gambar_produk) }}" id="preview"
                                class="mb-2 preview" style="width: 100px;">
                            <input class="form-control " type="file" accept=".png, .jpg, .jpeg" id="inputFoto"
                                name="gambar_produk" value="{{ $data->gambar_produk }}" onchange="previewImg()">

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Harga Produk</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="hargaProduk" name="harga_produk"
                                value="{{ $data->harga_produk }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Kategori</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="kategori" id="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="Pakaian & Celana"
                                    {{ $data->kategori === 'Pakaian & Celana' ? 'selected' : '' }}>Pakaian & Celana
                                </option>
                                <option value="Peralatan Outdoor"
                                    {{ $data->kategori === 'Peralatan Outdoor' ? 'selected' : '' }}>Peralatan Outdoor
                                </option>
                                <option
                                    value="Peralatan Keamanan"{{ $data->kategori === 'Peralatan Keamanan' ? 'selected' : '' }}>
                                    Peralatan Keamanan</option>
                                <option
                                    value="Sepatu & Sandal"{{ $data->kategori === 'Sepatu & Sandal' ? 'selected' : '' }}>
                                    Sepatu & Sandal</option>
                                <option value="Ransel" {{ $data->kategori === 'Ransel' ? 'selected' : '' }}>Ransel
                                </option>
                                <option value="Jaket & Jas Hujan"
                                    {{ $data->kategori === 'Jaket & Jas Hujan' ? 'selected' : '' }}>Jaket & Jas Hujan
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Deskripsi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                value="{{ $data->deskripsi }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">merk</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="merk" id="merk">
                                <option value="">Pilih Merk</option>
                                <option value="Consina"{{ $data->merk === 'Consina' ? 'selected' : '' }}>Consina</option>
                                <option value="Forester"{{ $data->merk === 'Forester' ? 'selected' : '' }}>Forester
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Ketinggian</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="ketinggian" id="ketinggian">
                                <option value="">Pilih Ketinggian</option>
                                <option value="Rendah" {{ $data->ketinggian === 'Rendah' ? 'selected' : '' }}>Rendah
                                </option>
                                <option value="Sedang" {{ $data->ketinggian === 'Sedang' ? 'selected' : '' }}>Sedang
                                </option>
                                <option value="Tinggi" {{ $data->ketinggian === 'Tinggi' ? 'selected' : '' }}>Tinggi
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Kesulitan</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="kesulitan" id="kesulitan">
                                <option value="">Pilih Kesulitan</option>
                                <option value="Rendah" {{ $data->kesulitan === 'Rendah' ? 'selected' : '' }}>Rendah
                                </option>
                                <option value="Sedang" {{ $data->kesulitan === 'Sedang' ? 'selected' : '' }}>Sedang
                                </option>
                                <option value="Tinggi" {{ $data->kesulitan === 'Tinggi' ? 'selected' : '' }}>Tinggi
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Lama Pendakian</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="lama_pendakian" id="lama_pendakian">
                                <option value="">Pilih Lama Pendakian</option>
                                <option value="Pendek" {{ $data->lama_pendakian === 'Pendek' ? 'selected' : '' }}>Pendek
                                </option>
                                <option value="Sedang" {{ $data->lama_pendakian === 'Sedang' ? 'selected' : '' }}>Sedang
                                </option>
                                <option value="Panjang" {{ $data->lama_pendakian === 'Panjang' ? 'selected' : '' }}>
                                    Panjang</option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Suhu</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="suhu" id="suhu">
                                <option value="">Pilih Suhu</option>
                                <option value="Dingin" {{ $data->suhu === 'Dingin' ? 'selected' : '' }}>Dingin</option>
                                <option value="Sedang" {{ $data->suhu === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Hangat" {{ $data->suhu === 'Hangat' ? 'selected' : '' }}>Hangat</option>

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

<script>
    function previewImg() {
        const fotoIn = document.querySelector('#inputFoto');
        const preview = document.querySelector('.preview');

        preview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(fotoIn.files[0]);

        oFReader.onload = function(oFREvent) {
            preview.src = oFREvent.target.result;
        }
    }
</script>
