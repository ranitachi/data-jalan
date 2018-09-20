<?php

use Illuminate\Database\Seeder;
use App\Models\Verified;
use Maatwebsite\Excel\Facades\Excel;

class VerifiedDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $results = Excel::load(storage_path('master/data.xlsx'))->toObject();

        foreach ($results as $data) {
            Verified::create([
                'enumerator' => $data->enumerator,
                'tanggal_submit' => $data->tanggal_submit,
                'no_bnba' => $data->no_bnba,
                'jenis_atap' => $data->jenis_atap,
                'kondisi_atap' => $data->kondisi_atap,
                'jenis_bangunan' => $data->jenis_bangunan,
                'kondisi_bangunan' => $data->kondisi_bangunan,
                'jenis_dinding' => $data->jenis_dinding,
                'kondisi_dinding' => $data->kondisi_dinding,
                'jenis_kakus' => $data->jenis_kakus,
                'kondisi_kakus' => $data->kondisi_kakus,
                'luas_lahan' => $data->luas_lahan,
                'status_lahan' => $data->status_lahan,
                'foto_rumah' => $data->foto_rumah,
                'foto_fisik_bangunan_1' => $data->foto_fisik_bangunan_1,
                'foto_fisik_bangunan_2' => $data->foto_fisik_bangunan_2,
                'latitude' => $data->latitude,
                'longtitude' => $data->longtitude
            ]);
        }
    }
}
