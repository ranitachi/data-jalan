<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kecamatan;
use App\Models\DataSitu;

class DataSituController extends Controller
{
    //
    function datasitu($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $ds=DataSitu::where('id_kecamatan',$kecm->id)->get();
        return view('frontend.pages.data-situ.detail')
            ->with('kecm',$kecm)
            ->with('kecamatan',$kecamatan)
            ->with('datasitu',$ds)
            ->with('kec',$kec);
        
    }

    public function view_tabular_situ()
    {
        $data = DataSitu::all();

        return view('frontend.pages.data-situ.table')->with('data', $data);
    }
}
