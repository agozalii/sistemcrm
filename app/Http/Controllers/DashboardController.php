<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMemberRequest;
use App\Models\KlasifikasiGunungModel;
use App\Models\ProdukModels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data dari tabel klasifikasigunung
        $gunungs = KlasifikasiGunungModel::all();

        // Kirim data ke view
        return view('member.dashboard', ['gunungs' => $gunungs])->with([
            'user' => Auth::user()
        ]);
    }

    // public function rekomendasi()
    // {
    //     // Mengambil data dari tabel klasifikasigunung
    //     $gunungs = KlasifikasiGunungModel::all();

    //     // Kirim data ke view
    //     return view('member.rekomendasi', compact('gunungs'));
    // }



    public function profil()
    {
        // Mengambil data pengguna yang sedang masuk
        $user = Auth::user();

        // Kirim data ke tampilan
        return view('member.profil', ['user' => $user]);
    }

    public function showmember($id)
    {
        $data = User::findOrFail($id);

        return view(
            'member.modal.EditMember',
            [
                'title' => 'Edit Data Member',
                'data' => $data,
            ]
        )->render();
    }

    public function updatemember(UpdateMemberRequest $request, User $produk, $id)
    {
        $data = User::findOrFail($id);

        $field = [
            'id' => $request->id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'nomor_telpon' => $request->nomor_telpon,
        ];
        $data::where('id', $id)->update($field);
        // Alert :: toast('Data Berhasil Disimpan', 'success');
        return redirect('/member/profil');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

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

    public function rekomendasi(Request $request)
    {
        $gunungs = KlasifikasiGunungModel::all();

        if ($request->has('gunung')) {
            $gunungId = $request->input('gunung');

            $gunung = KlasifikasiGunungModel::findOrFail($gunungId);

            $rekomendasiProduk = $this->getRekomendasiProduk($gunung);
        } else {
            $gunung = null;
            $rekomendasiProduk = null;
        }

        return view('member.rekomendasi', compact('gunungs', 'gunung', 'rekomendasiProduk'));
    }

    private function getRekomendasiProduk($gunung)
    {
        return ProdukModels::where(function ($query) use ($gunung) {
            $query->where('ketinggian', $gunung->ketinggian)
                ->orWhere('kesulitan', $gunung->kesulitan)
                ->orWhere('lama_pendakian', $gunung->lama_pendakian)
                ->orWhere('suhu', $gunung->suhu);
        })->get();
    }

    // public function detailGunung($id)
    // {
    //     $gunung = KlasifikasiGunungModel::findOrFail($id);

    // $produk = ProdukModels::where(function($query) use ($gunung) {
    //                          $query->where('ketinggian', $gunung->ketinggian)
    //                                ->orWhere('kesulitan', $gunung->kesulitan)
    //                                ->orWhere('lama_pendakian', $gunung->lama_pendakian)
    //                                ->orWhere('suhu', $gunung->suhu);
    //                      })
    //                      ->whereRaw('(ketinggian = ?) + (kesulitan = ?) + (lama_pendakian = ?) + (suhu = ?) >= 2',
    //                                 [$gunung->ketinggian, $gunung->kesulitan, $gunung->lama_pendakian, $gunung->suhu])
    //                      ->get();

    // return view('member.detail_gunung', compact('gunung', 'produk'));
    // }

    public function filterByCategory(Request $request, $id)
{
    $gunung = KlasifikasiGunungModel::findOrFail($id);
    $selectedCategory = $request->input('kategori');

    // Ambil produk yang sesuai dengan gunung
    $produk = ProdukModels::where(function($query) use ($gunung) {
                                $query->where('ketinggian', $gunung->ketinggian)
                                      ->orWhere('kesulitan', $gunung->kesulitan)
                                      ->orWhere('lama_pendakian', $gunung->lama_pendakian)
                                      ->orWhere('suhu', $gunung->suhu);
                            })
                            ->whereRaw('(ketinggian = ?) + (kesulitan = ?) + (lama_pendakian = ?) + (suhu = ?) >= 2',
                                       [$gunung->ketinggian, $gunung->kesulitan, $gunung->lama_pendakian, $gunung->suhu]);

    // Filter produk berdasarkan kategori jika dipilih
    if ($selectedCategory) {
        $produk->where('kategori', $selectedCategory);
    }

    $produk = $produk->get();

    // Load kategori produk
    $kategoriProduk = ProdukModels::distinct()->pluck('kategori');

    return view('member.detail_gunung', compact('gunung', 'produk', 'kategoriProduk'));
}



}
