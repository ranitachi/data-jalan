<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\DataIrigasi;

class DataIrigasiController extends Controller
{
    public function datairigasi($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $di=DataIrigasi::where('id_kecamatan','like',"$kc")->get();
        $panjang_saluran=$bangunan_utama=$bangunan_pelengkap=$daerah=$areal=array();
        foreach($di as $k=>$v)
        {
            $areal[str_slug($v->daerah_irigasi)]=$v->areal;
            $daerah[str_slug($v->daerah_irigasi)]=$v->daerah_irigasi;
            $panjang_saluran[str_slug($v->daerah_irigasi)]['primer']=$v->panjang_saluran_primer;
            $panjang_saluran[str_slug($v->daerah_irigasi)]['sekunder']=$v->panjang_saluran_sekunder;
            $panjang_saluran[str_slug($v->daerah_irigasi)]['tersier']=$v->panjang_saluran_tersier;
            $bangunan_utama[str_slug($v->daerah_irigasi)]['bendung']=$v->bangunan_utama_gedung;
            $bangunan_utama[str_slug($v->daerah_irigasi)]['pintu_air']=$v->bangunan_utama_pintu_air;
            $bangunan_utama[str_slug($v->daerah_irigasi)]['intake']=$v->bangunan_utama_intake;
            $bangunan_pelengkap[str_slug($v->daerah_irigasi)]['box_tersier']=$v->pelengkap_box_tersier;
            $bangunan_pelengkap[str_slug($v->daerah_irigasi)]['gorong']=$v->pelengkap_gorong;
            $bangunan_pelengkap[str_slug($v->daerah_irigasi)]['jembatan']=$v->pelengkap_jembatan;
        }
        // dd($bangunan_pelengkap);
        return view('frontend.pages.data-irigasi.detail')
            ->with('kecm',$kecm)
            ->with('areal',$areal)
            ->with('daerah',$daerah)
            ->with('panjang_saluran',$panjang_saluran)
            ->with('bangunan_utama',$bangunan_utama)
            ->with('bangunan_pelengkap',$bangunan_pelengkap)
            ->with('kecamatan',$kecamatan)
            ->with('kec',$kec);
    }

}
