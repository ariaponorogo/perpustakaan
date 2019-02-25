<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PengarangReq;
use App\MPengarang;
use App\MGlobal;


class PengarangControl extends Controller
{
    //
    public function index() {
        $pengarang = MPengarang::all(); 
        return view('data.data_pengarang',compact('pengarang')); 
      }
  
    function add() {
          $pengarang = MGlobal::Get_Row_Empty('tb_pengarang');
          return view('form.frm_pengarang',compact('pengarang'));
      }
  
    function edit($id) {
          $pengarang = MPengarang::where("kd_pengarang",$id)->first();
          return view('form.frm_pengarang',compact("pengarang"));
      }
  
      function save(Request $req) {
          if($req->get('kd_pengarang')=="") {
            $pengarang = new MPengarang([
                'kd_pengarang' => $req->get('kd_pengarang'),
                'nama_pengarang' => $req->get('nama'),
                'tempat' => $req->get('tempat'),
                'tgl_lahir' =>date("Y-m-d",strtotime($req->get('tgl_lahir'))),
                'alamat' => $req->get('alamat'),
                'kota' => $req->get('kota'),
        ]);
              $pengarang->save();
          } else {

              $pengarang = MPengarang::where("kd_pengarang",$req->get('kd_pengarang'));
              $pengarang->update([
                'kd_pengarang' => $req->get('kd_pengarang'),
                'nama_pengarang' => $req->get('nama'),
                'tempat' => $req->get('tempat'),
                'tgl_lahir' =>date("Y-m-d",strtotime($req->get('tgl_lahir'))),
                'alamat' => $req->get('alamat'),
                'kota' => $req->get('kota'),
              ]);
          }

          return redirect('pengarang');
      }
  
      function delete($id) {
          DB::table('tb_pengarang')->where('kd_pengarang',$id)->delete();

          return redirect('pengarang');
      }
}
