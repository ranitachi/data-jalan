<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kelurahan;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //kelurahan_tangerang_kab.xlsx
        $results = Excel::load(storage_path('master/kelurahan_tangerang_kab.xlsx'))->toObject();
        foreach($results as $data)
        {
            $kel=new Kelurahan;
            $kel->id_kecamatan=$data->id_kecamatan;
            $kel->nama_kelurahan=$data->nama_kelurahan;
            $kel->created_at=date('Y-m-d H:i:s');
            $kel->updated_at=date('Y-m-d H:i:s');
            $kel->save();
        }
    }
}
