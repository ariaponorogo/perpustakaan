<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mpeminjam;


class PinjamControl extends Controller
{
    //
    function index(){
        $pinjam = DB::select('SELECT * from tb_peminjaman');
        return view('report.rpt_peminjaman',compact('pinjam'));
    }
}
