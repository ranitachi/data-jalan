<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
class DataJalanController extends Controller
{
    public function datajalan($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"%$kc%")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        // dd($kecm);
        return view('frontend.pages.data-jalan.detail')
            ->with('kecm',$kecm)
            ->with('kecamatan',$kecamatan)
            ->with('kec',$kec);
    }
}
