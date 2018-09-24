<?php

use Illuminate\Database\Seeder;
use App\Models\Verified;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kecamatan;
use App\Models\DataJalan;
use App\Models\DataKondisiJalan;

class VerifiedDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
        // $results = Excel::load(storage_path('master/data.xlsx'))->toObject();

        // foreach ($results as $data) {
        //     Verified::create([
        //         'enumerator' => $data->enumerator,
        //         'tanggal_submit' => $data->tanggal_submit,
        //         'no_bnba' => $data->no_bnba,
        //         'jenis_atap' => $data->jenis_atap,
        //         'kondisi_atap' => $data->kondisi_atap,
        //         'jenis_bangunan' => $data->jenis_bangunan,
        //         'kondisi_bangunan' => $data->kondisi_bangunan,
        //         'jenis_dinding' => $data->jenis_dinding,
        //         'kondisi_dinding' => $data->kondisi_dinding,
        //         'jenis_kakus' => $data->jenis_kakus,
        //         'kondisi_kakus' => $data->kondisi_kakus,
        //         'luas_lahan' => $data->luas_lahan,
        //         'status_lahan' => $data->status_lahan,
        //         'foto_rumah' => $data->foto_rumah,
        //         'foto_fisik_bangunan_1' => $data->foto_fisik_bangunan_1,
        //         'foto_fisik_bangunan_2' => $data->foto_fisik_bangunan_2,
        //         'latitude' => $data->latitude,
        //         'longtitude' => $data->longtitude
        //     ]);
        // }
    }
}
