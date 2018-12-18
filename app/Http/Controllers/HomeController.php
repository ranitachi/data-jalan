<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\DataSungai;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function welcome()
    {
        // return view('welcome');
        $results = Excel::load(storage_path('master/data-sungai.xlsx'))->toObject();
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
            $kecm=trim($data->kecamatan);
            if($kecm!='')
            {
                $d_kcm=explode(',',$kecm);
                $kecamatan = $idkec='';
                if(count($d_kcm)>1)
                {
                    foreach($d_kcm as $k=>$vv)
                    {
                        $kc=strtolower(str_slug($vv));
                        $kecamatan.=(isset($kec[$kc]) ? $kec[$kc]->nama_kecamatan : 0).',';

                        $idkc=(isset($kec[$kc]) ? $kec[$kc]->id : 0);
                        $idkec.=$idkc.',';
                    }
                    $idkec=substr($idkec,0,-1);
                    $kecamatan=substr($kecamatan,0,-1);
                }
                else
                {
                    $kecamatan=$kecm;
                    $idkec=(isset($kec[$kecm]) ? $kec[$kecm]->id : 0);
                }

                list($nms,$jns)=explode('(',$data->nama_sungai);
                $jns=str_replace(array('(',')'),'',$jns);
                $nama_sungai=$nms;

                $da_situ=DataSungai::create([
                    'nama_sungai' => $nama_sungai,
                    'jenis' => strtolower($jns),
                    'id_kecamatan' => $idkec,
                    'kecamatan' => $kecamatan,
                    'panjang_sungai_primer' => $data->panjang_sungai_primer,
                    'panjang_sungai_sekunder' => $data->panjang_sungai_sekunder,
                    'panjang_sungai_tersier' => $data->panjang_sungai_tersier,
                    'bangunan_utama_bendung' => $data->bangunan_utama_bendung,
                    'bangunan_utama_pintu_air' => $data->bangunan_utama_pintu_air,
                    'bangunan_utama_bagi_sadap' => $data->bangunan_utama_bagi_sadap,
                    'bangunan_terlengkap_box_tersier' => $data->bangunan_terlengkap_box_tersier,
                    'bangunan_terlengkap_box_gorong' => $data->bangunan_terlengkap_box_gorong,
                    'bangunan_terlengkap_box_jembatan' => $data->bangunan_terlengkap_box_jembatan,
                    'saluran_bendung' => $data->saluran_bendung,
                    'saluran_tanah' => $data->saluran_tanah,
                    'sudah_dibangun_bendung' => $data->sudah_dibangun_bendung,
                    'sudah_dibangun_pintu_air' => $data->sudah_dibangun_pintu_air,
                    'sudah_dibangun_bagi_sadap' => $data->sudah_dibangun_bagi_sadap,
                    'sudah_dibangun_box_tersier' => $data->sudah_dibangun_box_tersier,
                    'sudah_dibangun_gorong' => $data->sudah_dibangun_gorong,
                    'sudah_dibangun_jembatan' => $data->sudah_dibangun_jembatan,
                    'sudah_dibangun_pasangan' => $data->sudah_dibangun_pasangan,
                    'sudah_dibangun_tanah' => $data->sudah_dibangun_tanah,
                    'sisa' => $data->sisa,
                    'keterangan' => $data->keterangan
                ]);
                   
            }
        }
    }
}
