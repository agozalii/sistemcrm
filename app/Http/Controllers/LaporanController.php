<?php

namespace App\Http\Controllers;

use App\Models\KlaimPoinModel;
use App\Models\KritikSaranModel;
use App\Models\TransaksiModel;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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
            'user' => FacadesAuth::user(),
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ]);
    }
    // public function laporanklaim(){
    //     $tgl_awal = request('tgl_awal');
    //     $tgl_akhir = request('tgl_akhir');
    //     $status = request('status');

    //     $query = KlaimPoinModel::query();

    //     if($tgl_awal && $tgl_akhir){
    //         $query->whereBetween('tgl_kirim', [date('Y-m-d', strtotime($tgl_awal)), date('Y-m-d', strtotime($tgl_akhir))]);
    //     }

    //     if($status){
    //         $query->where('status', $status);
    //     }

    //     $data = $query->get();

    //     return view('manajer.laporanklaim', [
    //         'data' => $data,
    //         'user' => FacadesAuth::user(),
    //         'tgl_awal' => $tgl_awal,
    //         'tgl_akhir' => $tgl_akhir,
    //         'status' => $status
    //     ]);
    // }



    // BENARR
    public function laporanklaim()
{
    $tgl_awal = request('tgl_awal');
    $tgl_akhir = request('tgl_akhir');
    $status = request('status');

    $query = KlaimPoinModel::query();

    if ($tgl_awal && $tgl_akhir) {
        $query->whereBetween('tgl_kirim', [date('Y-m-d', strtotime($tgl_awal)), date('Y-m-d', strtotime($tgl_akhir))]);
    }

    if ($status) {
        $query->where('status', $status);
    }

    $data = $query->get();

    // Query untuk menghitung jumlah gift yang statusnya "Terklaim"
    $giftCountsTerklaim = KlaimPoinModel::select('gift_id', \DB::raw('count(*) as total'))
        ->where('status', 'Terklaim')
        ->groupBy('gift_id')
        ->with('gift')
        ->get();

    // Query untuk menghitung jumlah gift yang statusnya "Ditolak" dan "Menunggu"
    $giftCountsOther = KlaimPoinModel::select('gift_id', 'status', \DB::raw('count(*) as total'))
        ->whereIn('status', ['Ditolak', 'Menunggu'])
        ->groupBy('gift_id', 'status')
        ->with('gift')
        ->get();

    return view('manajer.laporanklaim', [
        'data' => $data,
        'user' => FacadesAuth::user(),
        'tgl_awal' => $tgl_awal,
        'tgl_akhir' => $tgl_akhir,
        'status' => $status,
        'giftCountsTerklaim' => $giftCountsTerklaim,
        'giftCountsOther' => $giftCountsOther
    ]);
}


}
