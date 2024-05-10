<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\DetailTransaksiModel;
use App\Models\ProdukModels;
use App\Models\TransaksiModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// inihapus nnti
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TransaksiModel::with('user')->get();

        // Mengirimkan data transaksi dan data pengguna (user) ke tampilan
        return view('admin.transaksi', [
            'data' => $data,
            'user' => Auth::user()
        ]);
    }

    // INI JANGAN DIHAPUS NANTI DIKEMBALIKAN
    // public function addTransaksi()
    // {
    //     $users = User::all();
    //     return view("admin.modal.addTransaksi", [
    //         'title' => 'Tambah Data Transaksi',
    //         'users' => $users,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();  // Mengambil semua data pengguna dari tabel users
        return view('admin.modal.addTransaksi', compact('users'));
    }

    /** Store a newly created resource in storage. */
    // public function store(StoreTransaksiRequest $request)
    // {
    //     $request->validate([
    //         'tanggal_transaksi' => 'required|date',
    //         'total' => 'required|numeric',
    //         // Anda mungkin ingin menambahkan validasi lain sesuai kebutuhan
    //     ]);
    //     // Membuat instance baru dari model Transaksi
    //     $transaksi = new TransaksiModel();

    //     // Mengisi atribut-atribut transaksi
    //     $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
    //     $transaksi->total = $request->total;
    //     $transaksi->poin_diperoleh = $request->poin_diperoleh;

    //     // Menyimpan id user dari formulir ke dalam transaksi
    //     $transaksi->user_id = $request->input('nama');

    //     // Menyimpan transaksi
    //     $transaksi->save();

    //     // Mengembalikan pengguna ke halaman transaksi setelah penyimpanan
    //     return redirect('/transaksi')->with('success', 'Data berhasil tersimpan');
    // }

    /**
     * Display the specified resource.
     */
    public function show($id, $userId)
    {
        $data = TransaksiModel::findOrFail($id);
        $users = User::all();
        $totalPoin = TransaksiModel::getTotalPoin($userId);
        $user_id = Auth::id();

        return view(
            'admin.modal.EditTransaksi',
            [
                'title' => 'Edit Data Transaksi',
                'data' => $data,
                'users' => $users,
                'totalPoin' => $totalPoin
            ]
        )->render();
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
    public function update(UpdateTransaksiRequest $request, TransaksiModel $produk, $id)
    {
        $data = TransaksiModel::findOrFail($id);

        $field = [
            'nama' => $request->user_id,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total' => $request->total,
            'poin_diperoleh' => $request->poin_diperoleh,
        ];
        $data::where('id', $id)->update($field);
        // Alert :: toast('Data Berhasil Disimpan', 'success');
        return redirect('/transaksi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addTransaksi()
    {
        $produks = ProdukModels::all();
        $users = User::all();

        return view('admin.modal.addTransaksi', [
            'title' => 'Tambah  Transaksi',
            'id' => 'NT' . rand(100, 999),
            'produks' => $produks,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Validasi data yang diterima
            // dd($request->all());
            $validasi = Validator::make($request->all(), [
                'nama_pelanggan' => 'required',
                'tanggal_transaksi' => 'required',
                'total_transaksi' => 'required|numeric',
                // 'poin_diperoleh' => 'required|numeric',
                'produk_id' => 'required|array',
                'jumlah_beli_produk' => 'required|array',
            ]);

            if ($validasi->fails()) {
                $errors = $validasi->errors()->all();
                return back()->withErrors($errors)->withInput();
            }



            // Buat nomor order
            $no_order = 'NT-' . date('Ymd') . '-' . rand(100, 999);

            // Simpan data transaksi ke dalam tabel transaksi
            $transaksi = new TransaksiModel();
            $transaksi->id = $no_order;
            $transaksi->user_id = $request->nama_pelanggan;  // Gunakan nama pelanggan yang dipilih
            $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
            $transaksi->total = $request->total_transaksi;

            $point = $request->total_transaksi / 100;
            $transaksi->poin_diperoleh = $point;

            // Hitung total poin dari transaksi
            // $totalPoin = $request->poin_diperoleh;

            // Simpan total poin ke dalam kolom total_poin
            // $transaksi->total_poin = $totalPoin;

            $transaksi->save();

            foreach ($request->produk_id as $key => $value) {
                $produk = ProdukModels::findOrFail($value);

                $detailTransaksi = new DetailTransaksiModel();
                $detailTransaksi->transaksi_id = $no_order;
                $detailTransaksi->produk_id = $value;
                $detailTransaksi->harga_produk = $produk->harga_produk;
                $detailTransaksi->jumlah_beli_produk = $request->jumlah_beli_produk[$key];
                $detailTransaksi->save();
            }

            // Hitung total poin dari transaksi
            $user = User::where('id', $request->nama_pelanggan)->first();
            if($user->poin == null || $user->poin == 0){
                $user->poin = $transaksi->poin_diperoleh;
             }else{
                $user->poin += $transaksi->poin_diperoleh;
             }
            $user->save();

            // Respon sukses
            Session::flash('toast_success', 'Data transaksi berhasil disimpan');
            return redirect()->route('transaksi.index');
        } catch (\Exception $e) {
            Log::error('Error creating transaksi: ' . $e->getMessage());
            return back()->with('toast_error', 'Data transaksi gagal disimpan.');
        }
    }

    public function getPoinTotal($nama)
    {
        // Temukan pengguna berdasarkan nama
        $user = User::where('nama', $nama)->first();

        // Periksa apakah pengguna ditemukan
        if ($user) {
            // Ambil total poin diperoleh dari transaksi pengguna
            $poinTotal = $user->transaksis()->sum('poin_diperoleh');

            // Kembalikan respons JSON dengan total poin
            return response()->json(['poin_total' => $poinTotal]);
        } else {
            // Jika pengguna tidak ditemukan, kembalikan respons JSON dengan pesan error
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
