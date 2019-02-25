<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BukuReq;
use App\MGlobal;
use App\MBuku;
use App\MPengarang;
use App\MPenerbit;
use App\Mkategori;

class BukuControl extends Controller
{
    //
    public function index() {
      // $buku = DB::select('SELECT tb_buku.kd_buku,tb_buku.judul,tb_pengarang.nama_pengarang,tb_penerbit.nama_penerbit,tb_buku.tempat_terbit,tb_buku.tahun_terbit,tb_kategori.nama_kategori,tb_buku.halaman,tb_buku.edisi,tb_buku.ISBN FROM tb_buku,tb_pengarang,tb_penerbit,tb_kategori WHERE tb_buku.kd_pengarang = tb_pengarang.kd_pengarang AND tb_buku.kd_penerbit=tb_penerbit.kd_penerbit AND tb_buku.kd_kategori = tb_kategori.kd_kategori');
      $buku = MBuku::all(); 
      $pengarang = Mpengarang::all();
      $penerbit  = Mpenerbit::all();
      return view('data.data_buku',compact('buku','pengarang','penerbit')); 
    }

    function add() {
        $buku = MGlobal::Get_Row_Empty('tb_buku');
        $pengarang = MPengarang::all();
        $penerbit = MPenerbit::all();
        $kategori = MKategori::all();
        return view('form.frm_buku',compact('buku','pengarang','penerbit','kategori'));
    }

    function edit($id) {
        $buku = MBuku::where("kd_buku",$id)->first();
        $pengarang = MPengarang::all();
        $penerbit = MPenerbit::all();
        $kategori = MKategori::all();
        return view('form.frm_buku',compact('buku','pengarang','penerbit','kategori'));
    }

    function save(Request $req) {

        if($req->file('foto')) {
            $foto = $req->file('foto');
            $nama_foto = date('m-Y-').$foto->getClientOriginalName();
        } else {
            $nama_foto = $req->get('old_foto');
        }

        if($req->get('kd_buku')=="") {
            //tambahkan validasi buat sendiri

            //simpan ke tabel buku
            $anggota = new MBuku([
                'judul' => $req->get('judul'),
                'kd_pengarang' => $req->get('pengarang'),
                'kd_penerbit' => $req->get('penerbit'),
                'tempat_terbit' => $req->get('tempat_terbit'),
                'tahun_terbit' => $req->get('tahun_terbit'),
                'kd_kategori' => $req->get('kategori'),
                'halaman' => $req->get('halaman'),
                'edisi' => $req->get('edisi'),
                'ISBN' => $req->get('isbn'),
                'cover' => $nama_foto,
            ]);
            $anggota->save();
        } else {
            $anggota = MBuku::where("kd_buku",$req->get('kd_buku'));
            $anggota->update([
                'judul' => $req->get('judul'),
                'kd_pengarang' => $req->get('pengarang'),
                'kd_penerbit' => $req->get('penerbit'),
                'tempat_terbit' => $req->get('tempat_terbit'),
                'tahun_terbit' => $req->get('tahun_terbit'),
                'kd_kategori' => $req->get('kategori'),
                'halaman' => $req->get('halaman'),
                'edisi' => $req->get('edisi'),
                'ISBN' => $req->get('isbn'),
                'cover' => $nama_foto,
            ]);
        }

        //upload setelah data anggota tersimpan
        if($req->file('foto')) {
            $foto->move(public_path()."/img", $nama_foto);
        }

        return redirect('buku');
    }

    function delete($id) {
        $anggota = MBuku::where("kd_buku",$id);
        $anggota->delete();
        return redirect('buku');
    }
}
