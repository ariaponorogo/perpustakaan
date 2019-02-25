<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MBuku;

class MobileControl extends Controller
{
    //
    function get_Buku() {
        header("Access-Control-Allow-Origin: *");
        //$buku = MBuku::all();
        $buku = DB::select('SELECT tb_buku.*,tb_penerbit.nama_penerbit,tb_buku.tempat_terbit,tb_buku.tahun_terbit,tb_kategori.nama_kategori FROM tb_buku left join tb_pengarang on tb_buku.kd_pengaranng = tb_pengarang.kd_pengarang left join tb_penerbit on tb_buku.kd_penerbit = tb_penerbit.kd_penerbit left join tb_kategori on tb_buku.kd_kategori = tb_kategori.kd_kategori');
        foreach($buku as $rsBuku)(
            $rsBuku->cover=$rsBuku->cover==null ? asset("/img/no-cover.jpg") : asset("/img/".$rsBuku->cover);
            $data[] = $rsBuku;
        }

        echo json_encode($data);
        )

        function add_user(){
            header("Acces-Control-Allow-Origin: *");
            header("Acces-Control-Allow-Methods: ")
        }
}
