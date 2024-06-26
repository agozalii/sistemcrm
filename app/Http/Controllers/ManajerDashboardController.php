<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiModel;
use App\Models\GiftModel;
use App\Models\KlaimPoinModel;
use App\Models\KritikSaranModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tgl_awal = request('tgl_awal');
        $tgl_akhir = request('tgl_akhir');

        $arrBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $arrNilai = [
            '1' => 'Sangat Kurang',
            '2' => 'Kurang',
            '3' => 'Cukup',
            '4' => 'Baik',
            '5' => 'Sangat Baik'
        ];

        if ($tgl_awal && $tgl_akhir) {
            $gifts = GiftModel::with('klaimPoins')
                ->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->get();

            $grafikGift = [];
            foreach ($gifts as $gift) {
                $grafikGift[] = [
                    'nama_gift' => $gift->nama_gift,
                    'use' => $gift->klaimPoins->count(),
                ];
            }

            $topUser = KlaimPoinModel::select('user_id', DB::raw('count(*) as total_claims'))
                ->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->groupBy('user_id')
                ->orderBy('total_claims', 'desc')
                ->first();

            $memberLoyal = '';
            if ($topUser) {
                $user = User::find($topUser->user_id);
                if ($user) {
                    $memberLoyal = $user->nama;
                }
            }

            $kritikSarans = KritikSaranModel::query()
                ->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'desc')
                ->get();

            $pertambahan_member = [];

            foreach ($arrBulan as $key => $value) {
                $member = User::query()
                    ->where('role', 'manajer')
                    ->whereMonth('created_at', $key)
                    ->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                    ->count();

                $pertambahan_member[] = [
                    'bulan' => $key,
                    'nama_bulan' => $value,
                    'jumlah' => $member
                ];
            }

            $kepuasan = [];
            foreach ($arrNilai as $key => $value) {
                $kritikSaran = KritikSaranModel::query()
                    ->where('kepuasan', $key)
                    ->count();

                $kepuasan[] = [
                    'nama_rating' => $value,
                    'jumlah' => $kritikSaran
                ];
            }
        } else {
            $gifts = GiftModel::with('klaimPoins')->get();

            $grafikGift = [];
            foreach ($gifts as $gift) {
                $grafikGift[] = [
                    'nama_gift' => $gift->nama_gift,
                    'use' => $gift->klaimPoins->count(),
                ];
            }

            $topUser = KlaimPoinModel::select('user_id', DB::raw('count(*) as total_claims'))
                ->groupBy('user_id')
                ->orderBy('total_claims', 'desc')
                ->first();

            $memberLoyal = '';
            if ($topUser) {
                $user = User::find($topUser->user_id);
                if ($user) {
                    $memberLoyal = $user->nama;
                }
            }

            $kritikSarans = KritikSaranModel::query()
                ->orderBy('created_at', 'desc')
                ->get();

            $pertambahan_member = [];


            foreach ($arrBulan as $key => $value) {
                $member = User::query()
                    ->where('role', 'manajer')
                    ->whereMonth('created_at', $key)
                    ->count();

                $pertambahan_member[] = [
                    'bulan' => $key,
                    'nama_bulan' => $value,
                    'jumlah' => $member
                ];
            }

            $kepuasan = [];
            foreach ($arrNilai as $key => $value) {
                $kritikSaran = KritikSaranModel::query()
                    ->where('kepuasan', $key)
                    ->count();

                $kepuasan[] = [
                    'nama_rating' => $value,
                    'jumlah' => $kritikSaran
                ];
            }
        }
        return view('manajer.dashboard', [
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'grafikGift' => $grafikGift,
            'memberLoyal' => $memberLoyal,
            'kepuasan' => $kepuasan,
            'kritikSarans' => $kritikSarans,
            'pertambahan_member' => $pertambahan_member,
            'user' => auth()->user()
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
    public function store(Request $request)
    {
        //
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
