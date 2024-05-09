<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KlasifikasiGunung;
use App\Models\KlasifikasiGunungModel;
use App\Models\Produk;
use App\Models\ProdukModels;

class GunungController extends Controller
{
    public function index()
    {
        $gunungs = KlasifikasiGunungModel::all();
        return view('gunung.index', compact('gunungs'));
    }

    public function show($id)
    {
        $gunung = KlasifikasiGunungModel::findOrFail($id);
        $rekomendasiProduk = $this->getRekomendasiProduk($gunung);
        return view('gunung.show', compact('gunung', 'rekomendasiProduk'));
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
}
