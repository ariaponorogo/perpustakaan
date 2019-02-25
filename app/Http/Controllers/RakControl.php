<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RakReq;
use Illuminate\Support\Facades\DB;
use App\MRak;
use App\MGlobal;


class RakControl extends Controller
{
    //
    function index() {
        $rak = MRak::all(); 
        return view('data.data_rak',compact('rak')); 
      }
  
    function add() {
          $rak = MGlobal::Get_Row_Empty('tb_rak');
          return view('form.frm_rak',compact('rak'));
      }
  
    function edit($id) {
          $rak = MPengarang::where("kd_rak",$id)->first();
          return view('form.frm_rak',compact("rak"));
      }
  
      function save(Request $req) {
          if($req->get('kd_rak')=="") {
            $rak = new MRak([
                'nama_rak' => $req->get('rak'),
             ]);
              $rak->save();
          } else {
              $rak = MRak::where("kd_rak",$req->get('kd_rak'));
              $rak->update([
                'nama_rak' => $req->get('rak'),
              ]);
          }

          return redirect('rak');
      }
  
      function delete($id) {
          DB::table('tb_rak')->where('kd_rak',$id)->delete();

          return redirect('rak');
      }
}
