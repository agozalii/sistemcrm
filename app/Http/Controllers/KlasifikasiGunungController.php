<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGunungRequest;
use App\Http\Requests\UpdateGunungRequest;
use App\Models\KlasifikasiGunungModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlasifikasiGunungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query'); // Ambil query pencarian dari input form

        // Jika ada query pencarian, cari produk berdasarkan nama_produk
        if ($query) {
            $data = KlasifikasiGunungModel::where('nama_gunung', 'like', '%' . $query . '%')->paginate(3);
        } else {
            // Jika tidak ada query pencarian, tampilkan semua produk
            $data = KlasifikasiGunungModel::paginate(10);
        }

        return view("admin.klasifikasigunung", compact('data'))->with([
            'user' => Auth::user()
        ]);
    }

    public function addGunung()
    {
        return view("admin.modal.addGunung", [
            'title' => 'Tambah Data Gunung',
            'id' => 'GN' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
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
    public function store(StoreGunungRequest $request)
    {
        $data = new KlasifikasiGunungModel();
        $data->id = $request->id;
        $data->nama_gunung = $request->nama_gunung;
        $data->gambar_gunung = $request->gambar_gunung;
        $data->ketinggian = $request->ketinggian;
        $data->kesulitan = $request->kesulitan;
        $data->lama_pendakian = $request->lama_pendakian;
        $data->suhu = $request->suhu;

        if ($request->hasFile('gambar_gunung')) {
            $photo = $request->file('gambar_gunung');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/gunung'), $filename);
            $data->gambar_gunung = $filename;
        }

        // Alert::success('Berhasil', 'Data berhasil tersimpan');
        $data->save();
        return redirect('/klasifikasigunung');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = KlasifikasiGunungModel::findOrFail($id);

        return view(
            'admin.modal.EditGunung',
            [
                'title' => 'Edit Data Gunung',
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
    public function update(UpdateGunungRequest $request, KlasifikasiGunungModel $gunung, $id)
    {
        $data = KlasifikasiGunungModel::findOrFail($id);

        if ($request->file('gambar_gunung')) {
            $photo = $request->file('gambar_gunung');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/gunung'), $filename);
            $data->gambar_gunung = $filename;
        } else {
            $filename = $request->gambar_gunung;
        }

        $field = [
            'id' => $request->id,
            'nama_gunung' => $request->nama_gunung,
            'gambar_gunung' => $filename,
            'ketinggian' => $request->ketinggian,
            'kesulitan' => $request->kesulitan,
            'lama_pendakian' => $request->lama_pendakian,
            'suhu' => $request->suhu,
        ];
        $data::where('id', $id)->update($field);
        // Alert :: toast('Data Berhasil Disimpan', 'success');
        return redirect('/klasifikasigunung');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KlasifikasiGunungModel $gunung, $id)
    {
        $data = KlasifikasiGunungModel::find($id);
        $data->delete();
        // Alert :: toast('Data Berhasil Dihapus', 'success');
        //  return redirect('/produk');
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Menghapus Data',
        ]);
    }
}
