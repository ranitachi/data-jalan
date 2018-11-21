<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kecamatan;
use App\Models\DataJembatan;

class DataJembatanController extends Controller
{
    //
    function datasitu($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $ds=DataSitu::where('id_kecamatan',$kecm->id)->get();
        
    }
    public function datajembatan($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();

        $datajembatan=DataJembatan::where('id_kecamatan',$kecm->id)->get();

        return view('frontend.pages.data-jembatan.detail')
            ->with('kecm',$kecm)
            ->with('kecamatan',$kecamatan)
            ->with('datajembatan',$datajembatan)
            ->with('kec',$kec);
    }
    public function cek()
    {
        $results = Excel::load(storage_path('master/data-jembatan.xlsx'))->toObject();
        // echo count($results);
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $kec=array();
        foreach($kecamatan as $k)
        {
            $kec[strtolower(str_slug($k->nama_kecamatan))]=$k;
        }


        $dt=$det=array();
        $x=0;
        // dd($results);
        foreach($results as $data)
        {
            echo $data->kecamatan.'<br>';
        }
    }
}
