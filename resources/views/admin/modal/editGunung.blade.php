<div class="modal fade" id="editGunung" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content me-5" style="width: 700px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('updateGunung', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                        <label class="col-sm-5 col-form-label">Nama Gunung</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_gunung" name="nama_gunung"
                                value="{{ $data->nama_gunung }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Gambar Gunung</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="gambar_gunung" value="{{ $data->gambar_gunung }}">
                            <img src="{{ asset('storage/gunung/' . $data->gambar_gunung) }}" id="preview"
                                class="mb-2 preview" style="width: 100px;">
                            <input class="form-control " type="file" accept=".png, .jpg, .jpeg" id="inputFoto"
                                name="gambar_gunung" value="{{ $data->gambar_gunung }}" onchange="previewImg()">

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
