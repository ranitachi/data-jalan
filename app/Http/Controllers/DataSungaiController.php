<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\DataSungai;
class DataSungaiController extends Controller
{
    //
    public function datasungai($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $ds=DataSungai::where('id_kecamatan',$kecm->id)->get();
        return view('frontend.pages.data-sungai.detail')
            ->with('kecm',$kecm)
            ->with('kecamatan',$kecamatan)
            ->with('datasungai',$ds)
            ->with('kec',$kec);
    }
}
