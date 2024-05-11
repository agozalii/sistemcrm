@extends('layout.mainmember')

@section('judul')
    <strong>Halaman Transaksi</strong>
@endsection

@section('content')
    <h1 class="container text-center" style="margin-top: 75px;">Klaim Gift</h1>
    <h4 class="text-center">Poin Anda : {{ $user->poin }}</h4>
    <div class="container mb-4 mt-3">
        <div class="row">
            @foreach ($gifts as $gift)
                <div class="col-md-3 mb-4 mt-1">
                    <div class="card" style="width: 18rem;">
                        <form id="klaimPoinForm" action="{{ route('member.klaim.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="poin_cost" value="{{ $gift->poin_cost }}">
                            <input type="hidden" name="id" value="{{ $gift->id }}">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <img src="{{ asset('storage/gift/' . $gift->gambar_gift) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ ucwords($gift->nama_gift) }}</h5>
                                <p class="card-text">Harga Poin : <strong>{{ $gift->poin_cost }}</strong></p>
                                @if ($user->poin >= $gift->poin_cost)
                                    <button type="button" onclick="tukarPoin()" class="btn btn-primary" style="width: 100%">Tukar</button>
                                @else
                                    <button type="button" class="btn btn-primary" style="width: 100%" disabled>Tukar</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<script>
    function tukarPoin() {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin akan menukar poin Anda dengan ' + '{{ ucwords($gift->nama_gift) }}' + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tukar',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika dikonfirmasi, submit form
            document.getElementById("klaimPoinForm").submit();
        }
    });
}
</script>
