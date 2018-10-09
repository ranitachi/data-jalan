<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\DataSitu;

class DataSituSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $results = Excel::load(storage_path('master/data-situ.xlsx'))->toObject();
        // echo count($results);
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $kec=array();
        foreach($kecamatan as $k)
        {
            $kec[strtolower(str_slug($k->nama_kecamatan))]=$k;
        }
        $kelurahan=Kelurahan::all();
        $kel=array();
        foreach($kelurahan as $k)
        {
            $kel[strtolower(str_slug($k->nama_kelurahan))]=$k;
        }


        $dt=$det=array();
        $x=0;
        foreach($results as $data)
        {
            $kc=strtolower(str_slug($data->kecamatan));
            $kl=strtolower(str_slug($data->kelurahan));
            if(isset($kec[$kc]))
            {
                $d_kec=$kec[$kc];

                if(isset($kel[$kl]))
                {

                    $d_kel=$kel[$kl];
                    // $dt[$d->kecamatan][]=$d;
                    $da_situ=DataSitu::create([
                        'nama_situ' => $data->nama_situ,
                        'id_kecamatan' => $d_kec->id,
                        'id_kelurahan' => $d_kel->id,
                        'das' => $data->das,
                        'luas_asal' => $data->lusa_asal,
                        'luas_sekarang' => $data->luas_sekarang,
                        'pengelolaan_pusat' => ($data->pengelolaan_pusat=="" ? 0 : 1),
                        'pengelolaan_provinsi' => ($data->pengelolaan_provinsi=="" ? 0 : 1),
                        'pengelolaan_kabupaten' => ($data->pengelolaan_kabupaten=="" ? 0 : 1),
                        'kondisi' => $data->kondisi,
                        'keterangan' => $data->keterangan
                    ]);
                }
            }
        }

    }
}
