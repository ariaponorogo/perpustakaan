<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnggotaValReq;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use App\MAnggota;
use App\MGlobal;
use App\User;

class AnggotaControl extends Controller
{
    //
    function index(){
        $anggota = MAnggota::all();

        return view('data.data_anggota',compact('anggota'));
 
   }

   function add(){
       $anggota = MGlobal::Get_Row_Empty('tb_anggota');
       return view('form.frm_anggota',compact('anggota'));
   }

   function edit($id){
       $anggota = MAnggota::where("kd_anggota",$id)->first();
       return view('form.frm_anggota',compact('anggota'));
   }

   function save(AnggotaValReq $req){
        if($req->file('foto')){
            $foto = $req->file('foto');
            $nama_foto = date('m-Y-').$foto->getClientOriginalName();
        } else {
            $nama_foto = $req->get('old_foto');
        }

        if($req->get('kd_anggota')==""){
            // Tambahkan Validasi buat sendiri
            // Menciptakan kode anggota
            // A0001012019
            $newid = DB::select('SHOW TABLE STATUS LIKE "tb_anggota"');
            $noanggota = "A".sprintf('%04d',$newid[0]->Auto_increment).date("mY");

            // Simpan Ke Tabel Anggota
            $anggota = new MAnggota([
                'no_anggota' => $noanggota,
                'nama' => $req->get('nama'),
                'tempat' => $req->get('tempat'),
                'tgl_lahir' => date("Y-m-d",strtotime($req->get('tgl_lahir'))),
                'jk' => $req->get('jk'),
                'alamat' => $req->get('alamat'),
                'kota' => $req->get('kota'),
                'telp' => $req->get('telp'),
                'user_email' => $req->get('email'),
                'foto' => $nama_foto,
                'status'=>1
            ]);
            $anggota->save();
        } else {
            $anggota = MAnggota::where("kd_anggota",$req->get('kd_anggota'));
            $anggota->update([
                'nama' => $req->get('nama'),
                'tempat' => $req->get('tempat'),
                'tgl_lahir' => date("Y-m-d",strtotime($req->get('tgl_lahir'))),
                'jk' => $req->get('jk'),
                'alamat' => $req->get('alamat'),
                'kota' => $req->get('kota'),
                'telp' => $req->get('telp'),
                'user_email' => $req->get('email'),
                'foto' => $nama_foto,
                'status'=>1 
            ]);
        }

        // Upload setelah date anggota tersimpan
        if($req->file('foto')){
            $foto->move(public_path()."/img", $nama_foto);
        }

        return redirect('anggota');
    }

   function delete($kd_anggota){
    DB::table('tb_anggota')->where('kd_anggota',$kd_anggota)->delete();
    
    return redirect('anggota');
   }
}
