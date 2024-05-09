<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKritikSaranRequest;
use App\Models\KritikSaranModel;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.kritiksaran');
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
    // public function store(Request $request)
    // {

    // }

    // public function store(StoreKritikSaranRequest $request)
    // {
    //     $data = new KritiksaranModel();
    //     $data->isi_kritiksaran = $request->isi_kritiksaran;
    //     $data->tgl_kirim = $request->tgl_kirim;

    //     $data->save();

    //     return redirect('/member/kritiksaran');

    // }

    public function simpan(Request $request)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'isi_kritiksaran' => 'required',
        ]);

        // Simpan kritik dan saran
        KritikSaranModel::create([
            'user_id' => auth()->user()->id, // Ambil ID pengguna yang sedang login
            'isi_kritiksaran' => $request->isi_kritiksaran,
            'tgl_kirim' => now(), // Tanggal dan waktu saat ini
        ]);

        // Kembalikan respons
        return response()->json(['success' => true]);
    }

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
