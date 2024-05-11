<div class="modal fade" id="editGift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content me-5" style="width: 700px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('updateGift', $data->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Nama Gift</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_gift" name="nama_gift" value="{{$data->nama_gift}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Gambar</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="gambar_gift" value="{{ $data->gambar_gift }}">
                            <img src="{{ asset('storage/gift/' . $data->gambar_gift) }}" id="preview"
                                class="mb-2 preview" style="width: 100px;">
                            <input class="form-control " type="file" accept=".png, .jpg, .jpeg" id="inputFoto"
                                name="gambar_gift" value="{{ $data->gambar_gift }}" onchange="previewImg()">

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Poin</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="poin_cost" name="poin_cost" value="{{$data->poin_cost}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Deskripsi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{$data->deskripsi}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-7">
                            <select name="status" id="">
                                <option value="Menunggu" @if($data->status == 'Menunggu') selected @endif>Menunggu</option>
                                <option value="Terklaim" @if($data->status == 'Terklaim') selected @endif>Terklaim</option>
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
