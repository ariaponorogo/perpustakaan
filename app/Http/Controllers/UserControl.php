<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\MGlobal;


class UserControl extends Controller
{
    //
    function index(){
        $user = User::all();
        return view('data.data_user',compact('user'));
    }

    function add(){
        $user =MGlobal::Get_Row_Empty('users');
        return view('form.frm_user',compact('user'));
    }

    function edit($id){
        $user = User::where("id",$id)->first();
        return view('form.frm_user',compact('user'));
    }

    function save(Request $req){
        if($req->file('avatar')){
            $foto = $req->file('avatar');
            $nama_foto = date('m-Y-').$foto->getClientOriginalName();
        } else {
            $nama_foto = $req->get('old_avatar');
        }

        if($req->get('id')==""){

            //simpan tabel anggota
            $anggota = new User([
                'name' => $req->get('name'),
                'alamat' => $req->get('alamat'),
                'telp' => $req->get('telp'),
                'email' => $req->get('email'),
                'password' => Hash::make($req->get('password')),
                'level' => $req->get('level'),
                'avatar' => $nama_foto,
            ]);
            $anggota->save();
        } else {
            $anggota = User::where("id",$req->get('id'));  
            $anggota->update([
                'name' => $req->get('name'),
                'alamat' => $req->get('alamat'),
                'telp' => $req->get('telp'),
                'email' => $req->get('email'),
                'level' => $req->get('level'),
                'password' => $req->get('password') != "" ? Hash::make($req->get('password')) : $req->get('old_password'),
                'avatar' => $nama_foto,            
            ]);
        }

        //upload setelah data anggota tersimpan
        if($req->file('avatar')){
            $foto->move(public_path()."/img", $nama_foto);
        }

        return redirect('user');
    }

    function delete($id){
        $user = User::where("id",$id);        
        $user->delete();
        return redirect('user');
    }
}
