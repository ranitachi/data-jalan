<?php

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Rumahkumuh;
class RumahkumuhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kec=Kecamatan::all();
        $kc=array();
        foreach($kec as $k=>$v)
        {
            $kc[trim($v->nama_kecamatan)]=$v;
        }
        $path=public_path('kecamatan/rumah-kumuh.csv');
        $file=File::get($path);
        $ff=explode("\n",$file);
        // echo count($ff);
        foreach($ff as $key=>$value)
        {
            if($key>0)
            {
                $dt=explode(',',$value);
                $id=$dt[0];
                $d_kec=$dt[1];
                if(isset($kc[trim($d_kec)]))
                    $id_kec=$kc[trim($d_kec)]->id;
                else
                    $id_kec=-1;
                $kel=$dt[2];
                $alamat=$dt[3];
                $status=$dt[4];
                $kk=$dt[5];
                
                $simpan['id_kecamatan']=$id_kec;
                $simpan['alamat']=$alamat;
                $simpan['kelurahan']=$kel;
                $simpan['status_kesejahteraan']=$status;
                $simpan['nama_kk']=$kk;
                Rumahkumuh::create($simpan);
            }
        }
    }
}
