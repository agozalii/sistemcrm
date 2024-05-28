<?php

namespace App\Http\Controllers;

use App\Models\KritikSaranModel;
use Illuminate\Http\Request;

class UmpanBalikController extends Controller
{
    public function index(){
        $data = KritikSaranModel::all();
        
    }
}
