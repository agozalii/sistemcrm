@extends('layout.mainmember')

@section('judul')
    <strong>Halaman Transaksi</strong>
@endsection

@section('content')
<h1 class="container text-center" style="margin-top: 75px;">Klaim Gift</h1>
<div class="container mb-4 mt-3">
    <div class="row">
        @foreach ($gifts as $gift)
            <div class="col-md-3 mb-4 mt-1">
                <div class="item">
                    <div class="item-image"
                        style="width: 100%; height: 250px; border: 1px solid #ccc; position: relative;">
                        {{-- <a href="{{ route('statusklaim', ['nama_gift' => $gift->nama_gift]) }}">
                            <img src="{{ asset('storage/gift/' . $gift->gambar_gift) }}" class="card-img-top product-image" style="width: 100%; height: 100%; object-fit: cover;">
                            <button class="btn btn-warning" style="position: absolute; bottom: 10px; width: 90%; left: 50%; transform: translateX(-50%);">Tukar</button>
                        </a> --}}
                        <form id="klaimPoinForm" action="{{ route('statusklaim', ['nama_gift' => $gift->nama_gift]) }}" method="POST">
                            @csrf
                            <img src="{{ asset('storage/gift/' . $gift->gambar_gift) }}" class="card-img-top product-image" style="width: 100%; height: 100%; object-fit: cover;">
                            <button type="submit" class="btn btn-warning" style="position: absolute; bottom: 10px; width: 90%; left: 50%; transform: translateX(-50%);">Tukar</button>
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
<script>
    // Event listener untuk menangani submit formulir
    document.getElementById('klaimPoinForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah perilaku default formulir

        // Lakukan permintaan AJAX
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({}) // Kirimkan data kosong karena hanya perlu URL-nya
        })
        .then(response => {
            if (response.ok) {
                console.log('Klaim poin berhasil disimpan!');
                // Lakukan navigasi atau manipulasi DOM lainnya jika diperlukan
            } else {
                console.error('Terjadi kesalahan dalam menyimpan klaim poin.');
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        });
    });
</script>
@endsection
