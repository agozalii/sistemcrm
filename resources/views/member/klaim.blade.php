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
                <div class="item">
                    <div class="item-image"
                        style="width: 100%; height: 250px; border: 1px solid #ccc; position: relative;">
                        <form id="klaimPoinForm" action="{{ route('member.klaim.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="poin_cost" value="{{ $gift->poin_cost }}">
                            <input type="hidden" name="id" value="{{ $gift->id }}">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <img src="{{ asset('storage/gift/' . $gift->gambar_gift) }}" class="card-img-top product-image" style="width: 100%; height: 100%; object-fit: cover;">
                            <div>
                                <p class="ml-2">Harga Poin : <strong>{{$gift->poin_cost}}</strong></p>
                                @if($user->poin >= $gift->poin_cost)
                                <button type="submit" class="btn btn-warning" style="position: absolute; bottom: 10px; width: 90%; left: 50%; transform: translateX(-50%);">Tukar</button>
                                @else
                                    <button type="button" class="btn btn-warning" style="position: absolute; bottom: 10px; width: 90%; left: 50%; transform: translateX(-50%);" disabled>Tukar</button>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="item-meta text-center" style="font-size: 20px;">
                        <!-- Menambahkan font-size 15px dan centering -->
                        <p style="margin-top: 5px;">{{ ucwords($gift->nama_gift) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
