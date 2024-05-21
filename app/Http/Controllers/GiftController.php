<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGiftRequest;
use App\Http\Requests\UpdateGiftRequest;
use App\Models\GiftModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query'); // Ambil query pencarian dari input form

        // Jika ada query pencarian, cari produk berdasarkan nama_produk
        if ($query) {
            $data = GiftModel::where('nama_produk', 'like', '%' . $query . '%')->paginate(3);
        } else {
            // Jika tidak ada query pencarian, tampilkan semua produk
            $data = GiftModel::paginate(5);
        }

        return view("admin.gift", compact('data'))->with([
            'user' => Auth::user()
        ]);
    }

    public function addGift()
    {
        return view("admin.modal.addGift", [
            'title' => 'Tambah Data Gift',
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
    public function store(StoreGiftRequest $request)
    {
        $data = new GiftModel();
        $data->nama_gift = $request->nama_gift;
        $data->poin_cost = $request->poin_cost;
        $data->stock = $request->stock;
        $data->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar_gift')) {
            $photo = $request->file('gambar_gift');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/gift'), $filename);
            $data->gambar_gift = $filename;
        }

        // Alert::success('Berhasil', 'Data berhasil tersimpan');
        $data->save();
        return redirect('/gift');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = GiftModel::findOrFail($id);

        return view(
            'admin.modal.EditGift',
            [
                'title' => 'Edit Data Gift',
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
    public function update(UpdateGiftRequest $request, GiftModel $produk, $id)
    {
        $data = GiftModel::findOrFail($id);

        if ($request->file('gambar_gift')) {
            $photo = $request->file('gambar_gift');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/gift'), $filename);
            $data->gambar_gift = $filename;
        } else {
            $filename = $request->gambar_gift;
        }

        $field = [
            'nama_gift' => $request->nama_gift,
            'gambar_gift' => $filename,
            'poin_cost' => $request->poin_cost,
            'stock' => $request->stock,
            'deskripsi' => $request->deskripsi,
        ];
        $data::where('id', $id)->update($field);
        // Alert :: toast('Data Berhasil Disimpan', 'success');
        return redirect('/gift');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GiftModel $member, $id)
    {
        $data = GiftModel::find($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Menghapus Data',
        ]);
    }
}
