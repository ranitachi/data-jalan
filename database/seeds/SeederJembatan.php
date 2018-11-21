<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kecamatan;
use App\Models\DataJembatan;

class SeederJembatan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
        foreach($results as $data)
        {
            // $kkc=explode(',',$data->kecamatan);
            // if(count($kkc)>1)
            // {
            //     $nm_kec=$id_kec='';
            //     foreach($kkc as $idkc=>$vkc)
            //     {

            //         $kc=strtolower(str_slug($vkc));
            //         if(isset($kec[$kc]))
            //         {
            //             $d_kec=$kec[$kc]->id;
            //             $nm_kec.=$d_kec.',';
            //             $id_kec.=$d_kec.',';
            //         }
            //     }
            // }
            // else
            // {
                $kc=strtolower(str_slug($data->kecamatan));
                if(isset($kec[$kc]))
                {
                    $nm_kec=$kec[$kc]->nama_kecamatan;
                    $id_kec=$kec[$kc]->id;
                }
            

            $biaya=str_replace(array(',','.'),'',$data->biaya);
            $biaya_pr=str_replace(array(',','.'),'',$data->biaya_pr);
            $biaya_pp=str_replace(array(',','.'),'',$data->biaya_pp);
            $biaya_rehab=str_replace(array(',','.'),'',$data->biaya_rehab);
            $biaya_pkt=str_replace(array(',','.'),'',$data->biaya_pkt);
            // if($data->no_jembatan!=null)
            // {
                $data_jembatan=new DataJembatan;
                $data_jembatan->id_kecamatan = $id_kec;
                $data_jembatan->nama_kecamatan = $nm_kec;
                $data_jembatan->no_jembatan = $data->no_jembatan;
                $data_jembatan->no_ruas_jalan = $data->no_ruas_jalan;
                $data_jembatan->sta_jembatan = $data->sta_jembatan;
                $data_jembatan->vol_panjang_m = ($data->vol_panjang == '' ? 0 : $data->vol_panjang);
                $data_jembatan->vol_lebar_m = ($data->vol_lebar == '' ? 0 : $data->vol_lebar);
                $data_jembatan->vol_bentang = ($data->vol_bentang == '' ? 0 : $data->vol_bentang);
                $data_jembatan->vol_leb = ($data->vol_leb == '' ? 0 : $data->vol_leb);
                $data_jembatan->kondisi_b = strtolower($data->kondisi_b);
                $data_jembatan->kondisi_s = strtolower($data->kondisi_s);
                $data_jembatan->kondisi_r = strtolower($data->kondisi_r);
                $data_jembatan->kondisi_rb = strtolower($data->kondisi_rb);
                $data_jembatan->penanganan = $data->penanganan;
                $data_jembatan->volume = ($data->vol_m == '' ? 0 : $data->vol_m);
                $data_jembatan->biaya_total = ($biaya=='' ? 0 : $biaya);
                $data_jembatan->biaya_pr = ($biaya_pr=='' ? 0 : $biaya_pr);
                $data_jembatan->biaya_pp = ($biaya_pp=='' ? 0 : $biaya_pp);
                $data_jembatan->biaya_rehab = ($biaya_rehab=='' ? 0 : $biaya_rehab);
                $data_jembatan->biaya_pkt =  ($biaya_pkt=='' ? 0 : $biaya_pkt);
                $data_jembatan->keterangan = $data->ket;
                $data_jembatan->save();
            // }
        }
    
    }
}
