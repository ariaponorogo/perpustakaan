<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// https://mpdf.github.io/installation-setup/installation-v7-x.html 
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use App\MAnggota;
use App\MKoleksi;
use App\Mpeminjam;
use App\Mbuku;

class ReportControl extends Controller
{
    //

    function rpt_anggota(){
        $anggota = MAnggota::all();
        $content = view('report.rpt_anggota',compact('anggota'));

        $pdf = new Mpdf([
            'orientation'=>"L",
            'format'=>"folio"
        ]);

        $pdf->WriteHTML($content);
        $pdf->Output(public_path().'/Laporan Anggota.pdf','I');
    }

    function rpt_QRCode_Buku(){
        $buku = MKoleksi::all();

        $content = view('report.rpt_qrcode_buku',compact('buku'));

        $pdf = new MPdf([
            'orientation'=>"P",
            'format'=>"folio"
        ]);

        $pdf->WriteHTML($content);
        $pdf->Output(public_path().'/Laporan QR Code Buku.pdf','I');
    }

    function rpt_peminjaman(){
        $pinjam = Mpeminjam::all();
        $content = view('report.rpt_peminjaman',compact('pinjam'));
        $pdf = new Mpdf([
            'orientaion'=>"P",
            'format'=>"A4"
        ]);
        $pdf->WriteHTML($content);
        $pdf->Output(public_path().'/Laporan Peminjaman.pdf','I');
    }
    function rpt_data_buku_hilang(){
        $buku = DB::select('select tb_koleksi_buku.no_induk_buku,tb_buku.judul,tb_kategori.nama_kategori,tb_rak.nama_rak,tb_buku.ISBN,tb_koleksi_buku.status from tb_buku,tb_koleksi_buku,tb_kategori,tb_rak where tb_buku.kd_kategori=tb_kategori.kd_kategori and tb_buku.kd_buku=tb_koleksi_buku.kd_buku and tb_koleksi_buku.kd_rak=tb_rak.kd_rak and status = 3');
        $content = view('report.rpt_data_buku_tersedia',compact('buku'));
        $pdf = new MPdf([
            'orientation'=>"L",
            'format'=>"Folio"
        ]);
        $pdf->WriteHTML($content);
        $pdf->Output(public_path().'/Laporan Buku Hilang.pdf','I');
    }
    function rpt_data_buku_rusak(){
        $buku = DB::select('select tb_koleksi_buku.no_induk_buku,tb_buku.judul,tb_kategori.nama_kategori,tb_rak.nama_rak,tb_buku.ISBN,tb_koleksi_buku.status from tb_buku,tb_koleksi_buku,tb_kategori,tb_rak where tb_buku.kd_kategori=tb_kategori.kd_kategori and tb_buku.kd_buku=tb_koleksi_buku.kd_buku and tb_koleksi_buku.kd_rak=tb_rak.kd_rak and status = 2');
        $content = view('report.rpt_data_buku_tersedia',compact('buku'));
        $pdf = new MPdf([
            'orientation'=>"L",
            'format'=>"Folio"
        ]);
        $pdf->WriteHTML($content);
        $pdf->Output(public_path().'/Laporan Buku Rusak.pdf','I');
    }

    function cetak($id){
        $anggota = Manggota::where("kd_anggota",$id)->first();
        $content = view('report.rpt_cetak_kartu',compact('anggota'));
        $pdf = new Mpdf([
            'orientation'=>"L",
            'format'=>"A6"
        ]);
        $pdf->WriteHTML($content);
        $pdf->Output(public_path().'/kartu.pdf','I');
    }
}
