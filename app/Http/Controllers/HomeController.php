<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MGlobal;
use App\MAnggota;
use App\MBuku;
use App\MKategori;
use App\MPenerbit;
use App\MPengarang;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $buku = DB::select('SELECT count(*) as jumlah from tb_buku ');
        $jumlahbuku = $buku[0]->jumlah;
        $anggota = DB::select('SELECT count(*) as jumlah from tb_anggota');
        $jumlahanggota= $anggota[0]->jumlah;
        return view('dashboard',compact('jumlahbuku','jumlahanggota'));
    }
    
}
