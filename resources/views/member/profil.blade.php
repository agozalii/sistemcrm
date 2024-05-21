@extends('layout.mainmember')

@section('judul')
    <strong>Halaman Profil</strong>
@endsection

@section('content')
    <div class="container" style="margin-top: 75px">
        <div class="page-hero">
            <h1 style="text-align: center; margin-bottom:30px;">Profil</h1>
        </div>
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <h6>Nama:</h6>
                            <input type="text" value="{{ $user->nama }}" class="form-control" id="nama" name="nama" readonly>
                        </div>

                        <div class="form-group">
                            <h6>Alamat:</h6>
                            <input type="text" value="{{ $user->alamat }}" class="form-control" id="alamat" name="alamat" readonly>
                        </div>

                        <div class="form-group">
                            <h6>Tanggal Lahir:</h6>
                            <input type="text" value="{{ $user->tgl_lahir }}" class="form-control" id="tgl_lahir" name="tgl_lahir" readonly>
                        </div>

                        <div class="form-group">
                            <h6>Jenis Kelamin:</h6>
                            <input type="text" value="{{ $user->jenis_kelamin }}" class="form-control" id="jenis_kelamin" name="jenis_kelamin" readonly>
                        </div>

                        <div class="form-group">
                            <h6>Email:</h6>
                            <input type="email" value="{{ $user->email }}" class="form-control" id="email" name="email" readonly>
                        </div>

                        <div class="form-group">
                            <h6>Nomor Telepon:</h6>
                            <input type="tel" value="{{ $user->nomor_telpon }}" class="form-control" id="nomor_telpon" name="nomor_telpon" readonly>
                        </div>
                        <button class="btn btn-info editMemberr" style="100px" data-id="{{ $user->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control[readonly] {
    font-style: italic;
}
    </style>


<div class="tampilEditData" style="display:none;"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $('.editMemberr').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('editMemberr', ['id' => ':id']) }}".replace(':id', id),
                    success: function(response) {
                        $('.tampilEditData').html(response).show();
                        $('#editMemberr').modal("show");
                    }
                });

            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
    </script>
@endsection
