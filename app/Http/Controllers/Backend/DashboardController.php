<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\DataJalan;
use App\Models\DataKondisiJalan;
use App\Models\DataIrigasi;
use App\Models\DataSitu;
use App\Models\DataSungai;
use App\Models\DataJembatan;
// use Excel;
class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('backend.pages.dashboard.index');
    }

    public function download_file($jenis)
    {
        if($jenis=='jalan')
        {
            $data=DataJalan::with('kecamatan')->get()->toArray();
            $kondisis=DataKondisiJalan::all();
            $kondisi=array();
            $kondisi=array();
            $persentase=array();
            foreach($kondisis as $kond)
            {
                $kondisi[$kond->id_data_jalan][$kond->jenis]['B']=$kond->kondisi_b;
                $kondisi[$kond->id_data_jalan][$kond->jenis]['S']=$kond->kondisi_s;
                $kondisi[$kond->id_data_jalan][$kond->jenis]['R']=$kond->kondisi_r;
                $kondisi[$kond->id_data_jalan][$kond->jenis]['RB']=$kond->kondisi_r_b;
                $persentase[$kond->id_data_jalan]=$kond->persentase_rusak;
            }
            $view='backend.pages.jalan.excel';
            $namafile='DataJalan';
            return view($view)->with('data',$data)->with('kondisi',$kondisi)->with('persentase',$persentase);
        }
        elseif($jenis=='irigasi')
        {
            $view='backend.pages.irigasi.excel';
            $namafile='DataIrigasi';
            $data=DataIrigasi::with('kecamatan')->get()->toArray();
            return view($view)->with('data',$data);
        }
        elseif($jenis=='situ')
        {
            $view='backend.pages.situ.excel';
            $namafile='DataSitu';
            $data=DataSitu::with('kecamatan')->with('kelurahan')->get()->toArray();
            return view($view)->with('data',$data);
        }
        elseif($jenis=='sungai')
        {
            $view='backend.pages.sungai.excel';
            $namafile='DataSungai';
            $data=DataSungai::all()->toArray();
            return view($view)->with('data',$data);
        }
        elseif($jenis=='jembatan')
        {
            $view='backend.pages.jembatan.excel';
            $namafile='DataSungai';
            $datajalan=DataJalan::get();
            $dj=array();
            foreach($datajalan as $k=>$v)
            {
                $dj[$v->no_ruas]=$v;
            }
            $data=DataJembatan::all()->toArray();
            return view($view)->with('data',$data)->with('jalan',$dj);
        }
        // return($kondisi);
        // Excel::create($namafile, function($excel) use($data,$view){
        //     $excel->sheet('Sheet1', function($sheet) use ($data,$view){
        //         $sheet->loadView($view)->with('data',$data);
        //     });
        // })->download('xls');
        
    }
}
