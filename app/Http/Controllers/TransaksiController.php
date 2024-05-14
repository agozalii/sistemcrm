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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = ProdukModels::all();
        $users = User::query()->where('role', 'member')->get();

        return view('admin.add-transaksi', [
            'title' => 'Tambah  Transaksi',
            'id' => 'NT' . rand(100, 999),
            'produks' => $produks,
            'users' => $users,
            'user' => Auth::user()
        ]);
    }

    public function getPoin(Request $request)
    {
        $id_user = $request->input('id_user');

        $user = User::findOrFail($id_user);

        return $user->poin;
    }

    public function edit($id)
    {
        $produks = ProdukModels::all();
        $users = User::query()->where('role', 'member')->get();

        $transaki = TransaksiModel::query()
            ->with(['user', 'detail'])
            ->where('id', $id)
            ->first();

        return view('admin.edit-transaksi', [
            'title' => 'Edit  Transaksi' . $transaki->user->nama,
            'produks' => $produks,
            'users' => $users,
            'user' => Auth::user(),
            'transaksi' => $transaki
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = TransaksiModel::query()
            ->with(['user', 'detail', 'detail.produk'])
            ->where('id', $id)
            ->first();

        $users = User::all();
        $produks = ProdukModels::all();

        return view(
            'admin.modal.EditTransaksi',
            [
                'title' => 'Edit Data Transaksi',
                'data' => $data,
                'users' => $users,
                'produks' => $produks
            ]
        )->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function view(string $id)
    {
        $transaksi = TransaksiModel::query()
            ->with(['user', 'detail', 'detail.produk'])
            ->where('id', $id)
            ->first();

        $user = Auth::user();
        // dd($user);

        return view('admin.show-transaksi', [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        try {
            $validasi = Validator::make($request->all(), [
                'id_user' => 'required',
                'tanggal_transaksi' => 'required',
                'total_transaksi' => 'required|numeric',
                'produk_id' => 'required|array',
                'jumlah_beli_produk' => 'required|array',
            ]);

            if ($validasi->fails()) {
                $errors = $validasi->errors()->all();
                return back()->withErrors($errors)->withInput();
            }

            $total_transaksi = $request->total_transaksi;

            if ($request->poin_ditukar != null || $request->poin_ditukar != 0) {
                $total_transaksi = $total_transaksi - $request->poin_ditukar;

                $user = User::where('id', $request->id_user)->first();
                if ($user->poin != null || $user->poin != 0) {
                    $user->poin = $user->poin - $request->poin_ditukar;
                }
                $user->save();
            }

            // Simpan data transaksi ke dalam tabel transaksi
            $transaksi = TransaksiModel::findOrFail($id);
            $transaksi->user_id = $request->id_user;  // Gunakan nama pelanggan yang dipilih
            $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
            $transaksi->total = $total_transaksi;

            $point = $total_transaksi / 100;
            $transaksi->poin_diperoleh = $point;
            $transaksi->poin_ditukar = $request->poin_ditukar;

            $transaksi->save();

            // Array untuk menyimpan jumlah beli per produk
            $produkCounts = [];

            // Kumpulkan jumlah beli per produk
            foreach ($request->produk_id as $key => $value) {
                if (isset($produkCounts[$value])) {
                    $produkCounts[$value] += $request->jumlah_beli_produk[$key];
                } else {
                    $produkCounts[$value] = $request->jumlah_beli_produk[$key];
                }
            }

            // dd($produkCounts);

            // Proses dan simpan detail transaksi
            foreach ($produkCounts as $produkId => $jumlahBeli) {
                $produk = ProdukModels::findOrFail($produkId);

                $detailTransaksi = DetailTransaksiModel::where('transaksi_id', $transaksi->id)->where('produk_id', $produkId)->first();
                if ($detailTransaksi) {
                    $detailTransaksi->jumlah_beli_produk = $jumlahBeli;
                } else {
                    $detailTransaksi = new DetailTransaksiModel();
                    $detailTransaksi->transaksi_id = $transaksi->id;
                    $detailTransaksi->produk_id = $produkId;
                    $detailTransaksi->harga_produk = $produk->harga_produk;
                    $detailTransaksi->jumlah_beli_produk = $jumlahBeli;
                }
                $detailTransaksi->save();
            }

            // Hitung total poin dari transaksi
            $user = User::where('id', $request->id_user)->first();
            if ($user->poin == null || $user->poin == 0) {
                $user->poin = $transaksi->poin_diperoleh;
            } else {
                $user->poin += $transaksi->poin_diperoleh;
            }
            $user->save();

            // Respon sukses
            Session::flash('success', 'Data transaksi berhasil diperbarui');
            return redirect()->route('transaksi.kasir');
        } catch (\Exception $e) {
            Log::error('Error update transaksi: ' . $e->getMessage());
            return back()->with('error', 'Data transaksi gagal disimpan.');
        }
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
        $users = User::query()->where('role', 'member')->get();

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
            $validasi = Validator::make($request->all(), [
                'id_user' => 'required',
                'tanggal_transaksi' => 'required',
                'total_transaksi' => 'required|numeric',
                'produk_id' => 'required|array',
                'jumlah_beli_produk' => 'required|array',
            ]);

            if ($validasi->fails()) {
                $errors = $validasi->errors()->all();
                return back()->withErrors($errors)->withInput();
            }

            $total_transaksi = $request->total_transaksi;

            if ($request->poin_ditukar != null || $request->poin_ditukar != 0) {
                $total_transaksi = $total_transaksi - $request->poin_ditukar;

                $user = User::where('id', $request->id_user)->first();
                if ($user->poin != null || $user->poin != 0) {
                    $user->poin = $user->poin - $request->poin_ditukar;
                }
                $user->save();
            }

            // Buat nomor order
            $no_order = 'NT-' . date('Ymd') . '-' . rand(100, 999);

            // Simpan data transaksi ke dalam tabel transaksi
            $transaksi = new TransaksiModel();
            $transaksi->id = $no_order;
            $transaksi->user_id = $request->id_user;  // Gunakan nama pelanggan yang dipilih
            $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
            $transaksi->total = $total_transaksi;

            $point = $total_transaksi / 100;
            $transaksi->poin_diperoleh = $point;
            $transaksi->poin_ditukar = $request->poin_ditukar;

            // Hitung total poin dari transaksi
            // $totalPoin = $request->poin_diperoleh;

            // Simpan total poin ke dalam kolom total_poin
            // $transaksi->total_poin = $totalPoin;

            $transaksi->save();

            // Hitung total poin dari transaksi

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
            $user = User::where('id', $request->id_user)->first();
            if ($user->poin == null || $user->poin == 0) {
                $user->poin = $transaksi->poin_diperoleh;
            } else {
                $user->poin += $transaksi->poin_diperoleh;
            }
            $user->save();

            // Respon sukses
            Session::flash('success', 'Data transaksi berhasil disimpan');
            return redirect()->route('transaksi.kasir');
        } catch (\Exception $e) {
            Log::error('Error creating transaksi: ' . $e->getMessage());
            return back()->with('error', 'Data transaksi gagal disimpan.');
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
