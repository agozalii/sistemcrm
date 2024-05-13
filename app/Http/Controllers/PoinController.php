<?php

namespace App\Http\Controllers;

use App\Models\GiftModel;
use App\Models\KlaimPoinModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function poin()
{
    $userId = Auth::id();

    // Menghitung total poin_diperoleh dari semua transaksi user
    $totalPoin = Auth::user()->poin;

    // Menghitung total kolom total dari semua transaksi user
    $totalTransaksi = DB::table('transaksi')
                        ->where('user_id', $userId)
                        ->sum('total');

    // Menghitung jumlah transaksi user
    $jumlahTransaksi = DB::table('transaksi')
                        ->where('user_id', $userId)
                        ->count();

    // Mengambil semua transaksi user
    $transactions = DB::table('transaksi')
                        ->where('user_id', $userId)
                        ->get();

    return view('member.poin', compact('transactions', 'totalPoin', 'totalTransaksi', 'jumlahTransaksi'));
}

public function klaim()
{
    $gifts = GiftModel::all();

    $user = Auth::user();

    // Kemudian kirimkan data ke tampilan menggunakan view()
    return view('member.klaim', compact('gifts', 'user'));

}

// public function statusklaim(Request $request, $nama_gift)
// {
//     // Ambil user yang sedang login
//     $user_id = auth()->id();

//     // Ambil ID gift dari gambar yang diklik (jika Anda membutuhkan)
//     $nama_gift = $request->nama_gift ?? null;

//     // Tanggal klaim diisi dengan tanggal saat ini
//     $tanggal_klaim = now();

//     // Status diisi dengan 'Menunggu'
//     $status = 'Menunggu';

//     // Simpan data klaim poin ke dalam tabel klaim_poin
//     KlaimPoinModel::create([
//         'user_id' => $user_id,
//         'nama_gift' => $nama_gift, // Jika membutuhkan ID gift
//         'tanggal_klaim' => $tanggal_klaim,
//         'status' => $status
//     ]);

//     // Ambil data klaim poin yang sudah disimpan
//     $klaimPoin = KlaimPoinModel::where('user_id', $user_id)->get();
//     $giftt = GiftModel::where('nama_gift', $nama_gift)->get();


//     // Redirect atau kembali ke halaman sebelumnya
//     return view('member.klaimstatus', compact('klaimPoin'))->with('nama_gift', $nama_gift);
// }

//
public function store(Request $request)
{
    // Tanggal klaim diisi dengan tanggal saat ini
    $tanggal_klaim = now();

    // Status diisi dengan 'Menunggu'
    $status = 'Menunggu';

    // Simpan data klaim poin ke dalam tabel klaim_poin
    $klaim = new KlaimPoinModel;
    $klaim->user_id = $request->user_id;
    $klaim->gift_id = $request->id;
    $klaim->tanggal_klaim = $tanggal_klaim;
    $klaim->status = $status;


    if ($klaim->save()) {

        $user = User::findOrFail($request->user_id);
        $user->poin -= $request->poin_cost; //update poin ketika berhasil klaim poin
        $user->save();
        // Redirect ke halaman sebelumnya dengan pesan sukses
        Session::flash('success', 'Berhasil klaim gift');
        return redirect()->route('member.statusklaim');
    } else {
        // Jika gift tidak ditemukan, kembalikan pesan error
    Session::flash('error', 'Gagal claim gift');
    return redirect()->back()->with('error', 'Nama gift tidak valid.');
    }

}

public function showStatusklaim()
{
    // Ambil data klaim poin yang sesuai dengan user yang sedang login
    $user_id = auth()->id();
    $klaimPoin = KlaimPoinModel::query()
            ->with(['gift', 'user'])
            ->where('user_id', $user_id)
            ->get();
    $user = Auth::user();

    // Kemudian kirimkan data tersebut ke view 'member.statusklaim'
    return view('member.klaimstatus', compact('klaimPoin', 'user'));
}


// return view('member.klaimstatus', compact('klaimPoin'));








    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
