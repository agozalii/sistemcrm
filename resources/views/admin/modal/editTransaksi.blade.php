<div class="modal fade" id="editTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content me-5" style="width: 700px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{route('updateTransaksi', $data->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Nama Member</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="nama" name="nama">
                                <option value="">Pilih Nama Member</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $data->user_id == $user->id ? 'selected' : '' }}>{{ $user->nama }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                        <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="{{$data->tanggal_transaksi}}">

                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Total Transaksi</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="total" name="total"  value="{{$data->total}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Poin Diperoleh</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="poin_diperoleh" name="poin_diperoleh"
                            value="{{$data->poin_diperoleh}}">
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
