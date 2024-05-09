<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Illuminate\Http\Request;
use App\Models\ProdukModels;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    //     $data = ProdukModels::all();
    //     return view("kasir.produk", compact('data'))->with([
    //         'user' => Auth::user()
    //     ]);
    // }

    public function index(Request $request)
    {
        $query = $request->input('query'); // Ambil query pencarian dari input form

        // Jika ada query pencarian, cari produk berdasarkan nama_produk
        if ($query) {
            $data = ProdukModels::where('nama_produk', 'like', '%' . $query . '%')->paginate(3);
        } else {
            // Jika tidak ada query pencarian, tampilkan semua produk
            $data = ProdukModels::paginate(10);
        }

        return view("kasir.produk", compact('data'))->with([
            'user' => Auth::user()
        ]);
    }


    public function addProduk()
    {
        return view("kasir.modal.addProduk", [
            'title' => 'Tambah Data Produk',
            'id' => 'PR' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
        ]);
    }

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
    public function store(StoreProdukRequest $request)
    {
        $data = new ProdukModels();
        $data->id = $request->id;
        $data->nama_produk = $request->nama_produk;
        $data->harga_produk = $request->harga_produk;
        $data->kategori = $request->kategori;
        $data->deskripsi = $request->deskripsi;
        $data->merk = $request->merk;
        $data->ketinggian = $request->ketinggian;
        $data->kesulitan = $request->kesulitan;
        $data->lama_pendakian = $request->lama_pendakian;
        $data->suhu = $request->suhu;

        if ($request->hasFile('gambar_produk')) {
            $photo = $request->file('gambar_produk');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/produk'), $filename);
            $data->gambar_produk = $filename;
        }

        // Alert::success('Berhasil', 'Data berhasil tersimpan');
        $data->save();
        return redirect('/produk');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = ProdukModels::findOrFail($id);

        return view(
            'kasir.modal.EditProduk',
            [
                'title' => 'Edit Data Produk',
                'data' => $data,
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
    public function update(UpdateProdukRequest $request, ProdukModels $produk, $id)
    {
        $data = ProdukModels::findOrFail($id);

        if ($request->file('gambar_produk')) {
            $photo = $request->file('gambar_produk');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/produk'), $filename);
            $data->gambar_produk = $filename;
        } else {
            $filename = $request->gambar_produk;
        }

        $field = [
            'id' => $request->id,
            'nama_produk' => $request->nama_produk,
            'gambar_produk' => $filename,
            'harga_produk' => $request->harga_produk,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'merk' => $request->merk,
            'ketinggian' => $request->ketinggian,
            'kesulitan' => $request->kesulitan,
            'lama_pendakian' => $request->lama_pendakian,
            'suhu' => $request->suhu,
        ];
        $data::where('id', $id)->update($field);
        // Alert :: toast('Data Berhasil Disimpan', 'success');
        return redirect('/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdukModels $produk, $id)
    {
        $data = ProdukModels::find($id);
        $data->delete();
        // Alert :: toast('Data Berhasil Dihapus', 'success');
        //  return redirect('/produk');
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Menghapus Data',
        ]);
    }
}
