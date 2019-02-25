<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BukuReq;
use Illuminate\Support\Facades\DB;
use App\MGlobal;
use App\Manggota;
use App\Mbuku;
use App\Mkategori;
use App\Mpenerbit;
use App\Mpengarang;

class DashControl extends Controller
{
    //
    public function index(){
        $book = DB::select('SELECT count(*) as jumlah from tb_buku ');
        $jumlahbuku = $book[0]->jumlah;
        $anggota = DB::select('SELECT count(*) as jumlah from tb_anggota');
        $jumlahanggota= $anggota[0]->jumlah;
        $buku =DB::select('select tb_buku.kd_buku,tb_buku.judul,tb_pengarang.nama_pengarang,tb_penerbit.nama_penerbit,tb_buku.tempat_terbit,tb_buku.tahun_terbit,tb_kategori.nama_kategori,tb_buku.halaman,tb_buku.edisi,tb_buku.ISBN FROM tb_buku,tb_pengarang,tb_penerbit,tb_kategori WHERE tb_buku.kd_pengarang=tb_pengarang.kd_pengarang AND tb_buku.kd_penerbit=tb_penerbit.kd_penerbit AND tb_buku.kd_kategori=tb_kategori.kd_kategori');
        
        return view('dashboard',compact('jumlahbuku','jumlahanggota'));
    }
}
