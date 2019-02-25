<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\KategoriReq;
use Illuminate\Support\Facades\DB;
use App\Mkategori;
use App\Mglobal;

class KategoriControl extends Controller
{
    //
    function index(){
        $kategori = Mkategori::all();
        return view('data.data_kategori',compact('kategori'));
    }
    function add(){
        $kategori =  $rak = Mglobal::Get_Row_Empty('tb_kategori');
        return view('form.frm_kategori',compact('kategori'));
    }
    function edit($kd_kategori){
        $kategori = Mkategori::where("kd_kategori",$kd_kategori)->first();
        return view('form.frm_kategori',compact('kategori'));
    }
    function save(KategoriReq $req){
        if($req->get('kd_kategori')==""){
            $kategori = new Mkategori([
                'nama_kategori'=>$req->get('nama_kategori'),
                'singkatan'=>$req->get('singkatan')
            ]);
            $kategori->save();
        }else {
            $kategori = Mkategori::where("kd_kategori",$req->get('kd_kategori'));  
            $kategori->update([
                'nama_kategori'=>$req->get('nama_kategori'),
                'singkatan'=>$req->get('singkatan')
            ]);
        }
        return redirect('penerbit');
    }
    function delete($id){
        DB::table('tb_kategori')->where('kd_kategori',$id)->delete();
        return redirect('kategori');
    }
}
