<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PenerbitReq;
use App\MPenerbit;
use App\MGlobal;

class PenerbitControl extends Controller
{
    //
    function index() {
        $penerbit = MPenerbit::all(); 
        return view('data.data_penerbit',compact('penerbit')); 
      }
  
    function add() {
          $penerbit = MGlobal::Get_Row_Empty('tb_penerbit');
          return view('form.frm_penerbit',compact('penerbit'));
      }
  
    function edit($id) {
          $penerbit = MPenerbit::where("kd_penerbit",$id)->first();
          return view('form.frm_penerbit',compact("penerbit"));
      }
  
      function save(Request $req) {
          if($req->get('kd_penerbit')=="") {
            $penerbit = new MPenerbit([
                'kd_penerbit' => $req->get('kd_penerbit'),
                'nama_penerbit' => $req->get('nama'),
                'alamat' => $req->get('alamat'),
                'kota' => $req->get('kota'),
                'telp' => $req->get('telp'),
                'email' => $req->get('email'),
        ]);
              $penerbit->save();
          } else {
              $penerbit = MPenerbit::where("kd_penerbit",$req->get('kd_penerbit'));
              $penerbit->update([
                'kd_penerbit' => $req->get('kd_penerbit'),
                'nama_penerbit' => $req->get('nama'),
                'alamat' => $req->get('alamat'),
                'kota' => $req->get('kota'),
                'telp' => $req->get('telp'),
                'email' => $req->get('email'),
              ]);
          }

          return redirect('buku');
      }
  
      function delete($id) {
          DB::table('tb_penerbit')->where('kd_penerbit',$id)->delete();

          return redirect('penerbit');
      }
}
