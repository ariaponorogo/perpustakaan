<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Manggota;

class CetakControl extends Controller
{
    //
    function index(){
        $anggota = Manggota::where("kd_anggota",$id)->first();
        return view('cetak_kartu',compact('anggota'));
    }
}
