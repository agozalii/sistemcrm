<?php

namespace App\Http\Controllers;

use App\Models\KritikSaranModel;
use App\Models\TransaksiModel;
use Auth;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        $tgl_awal = request('tgl_awal');
        $tgl_akhir = request('tgl_akhir');

        if($tgl_awal && $tgl_akhir){
            $data = KritikSaranModel::query()
            ->whereBetween('tgl_kirim', [date('Y-m-d', strtotime($tgl_awal)), date('Y-m-d', strtotime($tgl_akhir))])
            ->get();
        }else{
            $data = KritikSaranModel::query()
            ->get();
        }

        return view('manajer.laporan', [
            'data' => $data,
            'user' => Auth::user(),
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ]);
    }
}
