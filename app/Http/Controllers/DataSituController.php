<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kecamatan;
use App\Models\DataIrigasi;

class DataSituController extends Controller
{
    //
    function datairigasi()
    {
        $results = Excel::load(storage_path('master/data-irigasi.xlsx'))->toObject();
        // echo count($results);
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $kec=array();
        foreach($kecamatan as $k)
        {
            $kec[strtolower(str_slug($k->nama_kecamatan))]=$k;
        }
        dd($results[1]);

        $dt=$det=array();
        $x=0;
        foreach($results as $data)
        {
            $kkc=explode(',',$data->kecamatan);
            if(count($kkc)>1)
            {
                $nm_kec='';
                foreach($kkc as $idkc=>$vkc)
                {

                    $kc=strtolower(str_slug($vkc));
                    if(isset($kec[$kc]))
                    {
                        $d_kec=$kec[$kc];
                        $nm_kec.=$d_kec.',';
                    }
                }
            }
            else
            {
                $kc=strtolower(str_slug($data->kecamatan));
                if(isset($kec[$kc]))
                {
                    $nm_kec=$kec[$kc];
                }
            }

            $data_irigasi=new DataIrigasi;
            $data_irigasi->daerah_irigasi=$data->daerah_irigasi;
            $data_irigasi->id_kecamatan=$nm_kec;
            $data_irigasi->areal=($data->areal=='-' ? 0 : $data->areal);
            $data_irigasi->panjang_saluran_primer=($data->primer =='-' ? 0 : $data->primer);
            $data_irigasi->panjang_saluran_sekunder=($data->sekunder =='-' ? 0 : $data->sekunder);
            $data_irigasi->panjang_saluran_tersier=($data->tersier =='-' ? 0 : $data->tersier);
            $data_irigasi->bangunan_utama_gedung=($data->bendung =='-' ? 0 : $data->bendung);
            $data_irigasi->bangunan_utama_pintu_air=($data->pintu_air =='-' ? 0 : $data->pintu_air);
            $data_irigasi->bangunan_utama_intake=($data->intake =='-' ? 0 : $data->intake);
            $data_irigasi->pelengkap_box_tersier=($data->box_tersier =='-' ? 0 : $data->box_tersier);
            $data_irigasi->pelengkap_gorong=($data->gorong2 =='-' ? 0 : $data->gorong2);
            $data_irigasi->pelengkap_jembatan=($data->jembatan =='-' ? 0 : $data->jembatan);
            $data_irigasi->sumber_air=$data->sumber_air;
            $data_irigasi->save();
        }
    }
}
