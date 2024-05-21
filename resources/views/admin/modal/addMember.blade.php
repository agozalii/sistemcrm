<div class="modal fade" id="addMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content me-5" style="width: 700px; ">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('addDataMember') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    {{-- <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Id Member</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control-plaintext" id="id" name="id"
                                value="{{ $id }}" readonly>
                        </div>
                    </div> --}}
                    <div class="mb-2 row">
                        <label class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="username" name="username" value="">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-5 col-form-label">Password</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="password" name="password" value="">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-5 col-form-label">Role</label>
                        <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="role" name="role" value="member">
                            <input type="text" class="form-control" id="role-display" value="Member" disabled>
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <label class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama" name="nama" value="">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="tgl_lahir" class="col-sm-5 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                    placeholder="Pilih tanggal lahir">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-5 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="email" name="email" value="">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-5 col-form-label">Nomor telepon</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nomor_telpon" name="nomor_telpon"
                                value="">
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#tgl_lahir', {
            dateFormat: 'Y-m-d',
            maxDate: 'today', // Mulai dari hari ini
        });
    </script>
