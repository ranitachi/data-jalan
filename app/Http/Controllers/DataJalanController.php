<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\DataJalan;
use App\Models\DataKondisiJalan;
use Maatwebsite\Excel\Facades\Excel;
class DataJalanController extends Controller
{
    public function datajalan($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        // dd($kecm);

        // $dj=DataJalan::all();
        $dj=DataJalan::where('id_kecamatan',$kecm->id)->get();
        $dkj=DataKondisiJalan::all();
        $kondisi=$sumkond=$datajalan=array();
        foreach($dkj as $k=>$v)
        {
            $kondisi[$v->id_data_jalan][$v->jenis][$v->kondisi_b]=$v;
            $sumkond[$v->id_data_jalan][$v->jenis]['b']=$v->kondisi_b;
            $sumkond[$v->id_data_jalan][$v->jenis]['s']=$v->kondisi_s;
            $sumkond[$v->id_data_jalan][$v->jenis]['r']=$v->kondisi_r;
            $sumkond[$v->id_data_jalan][$v->jenis]['rb']=$v->kondisi_r_b;
            $sumkond[$v->id_data_jalan]['persetase']=$v->persentase_rusak;
        }
        // dd($sumkond);
        $beton=$aspal=$dll=array();
        foreach($dj as $idj=>$vdj)
        {
            if(isset($kondisi[$vdj->id]))
            {
                $beton[]=$vdj->type_kons_beton;
                $aspal[]=$vdj->type_kons_aspal;
                $dll[]=$vdj->type_kons_dll;
            }
        }
        $grafik['beton']=$beton;
        $grafik['aspal']=$aspal;
        $grafik['dll']=$dll;
        // dd(array_sum($dll));
        return view('frontend.pages.data-jalan.detail')
            ->with('kecm',$kecm)
            ->with('grafik',$grafik)
            ->with('kecamatan',$kecamatan)
            ->with('kec',$kec);
    }
    public function jumlahruasjalan($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        // dd($kecm);

        // $dj=DataJalan::all();
        $dj=DataJalan::where('id_kecamatan',$kecm->id)->get();
        $dkj=DataKondisiJalan::all();
        $kondisi=$sumkond=$datajalan=array();
        foreach($dkj as $k=>$v)
        {
            $kondisi[$v->id_data_jalan][$v->jenis][$v->kondisi_b]=$v;
            $sumkond[$v->id_data_jalan][$v->jenis]['b']=$v->kondisi_b;
            $sumkond[$v->id_data_jalan][$v->jenis]['s']=$v->kondisi_s;
            $sumkond[$v->id_data_jalan][$v->jenis]['r']=$v->kondisi_r;
            $sumkond[$v->id_data_jalan][$v->jenis]['rb']=$v->kondisi_r_b;
            $sumkond[$v->id_data_jalan]['persetase']=$v->persentase_rusak;
        }
        // dd($sumkond);
        $beton=$aspal=$dll=array();
        foreach($dj as $idj=>$vdj)
        {
            if(isset($kondisi[$vdj->id]))
            {
                $beton[]=$vdj->type_kons_beton;
                $aspal[]=$vdj->type_kons_aspal;
                $dll[]=$vdj->type_kons_dll;
            }
        }
        $grafik['beton']=$beton;
        $grafik['aspal']=$aspal;
        $grafik['dll']=$dll;
        $total= array_sum($beton) + array_sum($aspal) + array_sum($dll);
        return response()->json([
            "status"    => true,
            "verified"  => number_format($total,2),
            "data"      => array()
        ], 200);
    }
    public function load_data()
    {
        $results = Excel::load(storage_path('master/data-jalan.xlsx'))->toObject();
        // echo count($results);
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $kec=array();
        foreach($kecamatan as $k)
        {
            $kec[strtolower(str_slug($k->nama_kecamatan))]=$k;
        }


        $dt=$det=array();
        $x=0;
        foreach($results as $data)
        {
            $kc=strtolower(str_slug($data->kecamatan));
            if(isset($kec[$kc]))
            {
                $d_kec=$kec[$kc];
                // $dt[$d->kecamatan][]=$d;
                $d_jalan=DataJalan::create([
                    'id_kecamatan' => $d_kec->id,
                    'nama_jalan' => $data->nama_jalan,
                    'no_ruas' => $data->no_ruas,
                    'vol_panjang_km' => $data->panjang_km=='-' ? 0 : $data->panjang_km,
                    'vol_lebar_m' => $data->lebar_m=='-' ? 0 : $data->lebar_m,
                    'luas_jalan_m_2' => $data->luas_m_2=='-' ? 0 : $data->luas_m_2,
                    'type_kons_beton' => $data->beton_km=='-' ? 0 :  $data->beton_km,
                    'type_kons_aspal' => $data->aspal_km =='-' ? 0 :  $data->aspal_km,
                    'type_kons_dll' => $data->dll_km=='-' ? 0 : $data->dll_km,
                    'keterangan' => $data->keterangan
                ]);

                $beton['id_data_jalan']=$d_jalan->id;
                $beton['kondisi_b']=$data->beton_b=='-' ? 0 : $data->beton_b;
                $beton['kondisi_s']=$data->beton_s=='-' ? 0 : $data->beton_s;
                $beton['kondisi_r']=$data->beton_r=='-' ? 0 : $data->beton_r;
                $beton['kondisi_r_b']=$data->beton_rb=='-' ? 0 : $data->beton_rb;
                $beton['persentase_rusak']=$data->persentase;
                $beton['jenis']='beton';
                DataKondisiJalan::create($beton);

                $aspal['id_data_jalan']=$d_jalan->id;
                $aspal['kondisi_b']=$data->aspal_b=='-' ? 0 : $data->aspal_b;
                $aspal['kondisi_s']=$data->aspal_s=='-' ? 0 : $data->aspal_s;
                $aspal['kondisi_r']=$data->aspal_r=='-' ? 0 : $data->aspal_r;
                $aspal['kondisi_r_b']=$data->aspal_rb=='-' ? 0 : $data->aspal_rb;
                $aspal['persentase_rusak']=$data->persentase;
                $aspal['jenis']='aspal';
                DataKondisiJalan::create($aspal);
                
                $dll['id_data_jalan']=$d_jalan->id;
                $dll['kondisi_b']=$data->dll_b=='-' ? 0 : $data->dll_b;
                $dll['kondisi_s']=$data->dll_s=='-' ? 0 : $data->dll_s;
                $dll['kondisi_r']=$data->dll_r=='-' ? 0 : $data->dll_r;
                $dll['kondisi_r_b']=$data->dll_rb=='-' ? 0 : $data->dll_rb;
                $dll['persentase_rusak']=$data->persentase;
                $dll['jenis']='dll';
                DataKondisiJalan::create($dll);

                $x++;
            }
        }
        // dd($dt);
    }
}
