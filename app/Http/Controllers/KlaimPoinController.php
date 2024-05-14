<?php

namespace App\Http\Controllers;

use App\Models\GiftModel;
use App\Models\KlaimPoinModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlaimPoinController extends Controller
{
    public function index(){

        $data = KlaimPoinModel::query()
                ->with(['user', 'gift'])
                ->get();

        $user = Auth::user();

        return view('admin.klaim', [
            'title' => 'Klaim Poin',
            'data' => $data,
            'user' => $user
        ]);
    }

    public function update($id){
        $klaim = KlaimPoinModel::findOrFail($id);
        $klaim->status = 'Terklaim';
        if($klaim->save()){
            return 'success';
        }
        return redirect()->back();
    }

    public function reject($id){
        $klaim = KlaimPoinModel::findOrFail($id);
        $klaim->status = 'Ditolak';
        if($klaim->save()){
            $gift = GiftModel::findOrFail($klaim->gift_id);
            $gift->stock = $gift->stock + 1;
            if($gift->save()){
                $user = User::findOrFail($klaim->user_id);
                $user->poin = $user->poin + $gift->poin_cost;
                $user->save();
                return 'success';
            }
        }
        return redirect()->back();
    }
}
