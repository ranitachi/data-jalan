<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\DataSungai;
class DataSungaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
                        $kecamatan.=(isset($kec[$kc]) ? $kec[$kc]->nama_kecamatan : $vv).',';

                        $idkc=(isset($kec[$kc]) ? $kec[$kc]->id : 0);
                        $idkec.=$idkc.',';
                    }
                    $idkec=strtoupper(substr($idkec,0,-1));
                    $kecamatan=strtoupper(substr($kecamatan,0,-1));
                }
                else
                {
                    $kc=strtolower(str_slug($kecm));
                    $kecamatan=strtoupper((isset($kec[$kc]) ? $kec[$kc]->nama_kecamatan : $kecm));
                    $idkec=(isset($kec[$kc]) ? $kec[$kc]->id : 0);
                }

                list($nms,$jns)=explode('(',$data->nama_sungai);
                $jns=str_replace(array('(',')'),'',$jns);
                $nama_sungai=$nms;

                $da_situ=DataSungai::create([
                    'nama_sungai' => $nama_sungai,
                    'jenis' => strtolower($jns),
                    'id_kecamatan' => $idkec,
                    'kecamatan' => $kecamatan,
                    'panjang_sungai_primer' => str_replace(array(',','.'),'',$data->panjang_sungai_primer),
                    'panjang_sungai_sekunder' => str_replace(array(',','.'),'',$data->panjang_sungai_sekunder),
                    'panjang_sungai_tersier' => str_replace(array(',','.'),'',$data->panjang_sungai_tersier),
                    'bangunan_utama_bendung' => str_replace(array(',','.'),'',$data->bangunan_utama_bendung),
                    'bangunan_utama_pintu_air' => str_replace(array(',','.'),'',$data->bangunan_utama_pintu_air),
                    'bangunan_utama_bagi_sadap' => str_replace(array(',','.'),'',$data->bangunan_utama_bagi_sadap),
                    'bangunan_terlengkap_box_tersier' => str_replace(array(',','.'),'',$data->bangunan_terlengkap_box_tersier),
                    'bangunan_terlengkap_box_gorong' => str_replace(array(',','.'),'',$data->bangunan_terlengkap_box_gorong),
                    'bangunan_terlengkap_box_jembatan' => str_replace(array(',','.'),'',$data->bangunan_terlengkap_box_jembatan),
                    'saluran_bendung' => str_replace(array(',','.'),'',$data->saluran_bendung),
                    'saluran_tanah' => str_replace(array(',','.'),'',$data->saluran_tanah),
                    'sudah_dibangun_bendung' => str_replace(array(',','.'),'',$data->sudah_dibangun_bendung),
                    'sudah_dibangun_pintu_air' => str_replace(array(',','.'),'',$data->sudah_dibangun_pintu_air),
                    'sudah_dibangun_bagi_sadap' => str_replace(array(',','.'),'',$data->sudah_dibangun_bagi_sadap),
                    'sudah_dibangun_box_tersier' => str_replace(array(',','.'),'',$data->sudah_dibangun_box_tersier),
                    'sudah_dibangun_gorong' => str_replace(array(',','.'),'',$data->sudah_dibangun_gorong),
                    'sudah_dibangun_jembatan' => str_replace(array(',','.'),'',$data->sudah_dibangun_jembatan),
                    'sudah_dibangun_pasangan' => str_replace(array(',','.'),'',$data->sudah_dibangun_pasangan),
                    'sudah_dibangun_tanah' => str_replace(array(',','.'),'',$data->sudah_dibangun_tanah),
                    'sisa' => str_replace(array(',','.'),'',$data->sisa),
                    'keterangan' => $data->keterangan
                ]);
                   
            }
        }
    }
}
