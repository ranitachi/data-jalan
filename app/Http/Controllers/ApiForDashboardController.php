<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataJalan;
use App\Models\DataKondisiJalan;
use App\Models\DataIrigasi;
use App\Models\DataJembatan;
use App\Models\DataSungai;
use App\Models\DataSitu;
use App\Models\Kecamatan;

use DB;

class ApiForDashboardController extends Controller
{
    // public function data_situ_all() 
    // {
    //     return DataSitu::with('kecamatan')->get();
    // }

    // public function data_situ_per_kecamatan() 
    // {
    //     return DataSitu::select('id_kecamatan', DB::RAW("COUNT(*) as jumlah"))->groupby('id_kecamatan')
    //         ->with('kecamatan')->get();
    // }



    public function data_sungai_per_jenis() 
    {
        return DataSungai::select('jenis', DB::RAW('COUNT(*) as jumlah'))->groupby('jenis')->get();
    }

    public function data_jembatan_per_kecamatan()
    {
        return DataJembatan::select('nama_kecamatan', DB::RAW('count(*) as jumlah'), 
            DB::RAW('sum(vol_panjang_m) as total_panjang'), DB::RAW('sum(vol_lebar_m) as total_lebar'))
            ->groupby('nama_kecamatan')->get();
    }

    public function data_jembatan_all()
    {
        return DataJembatan::all();
    }
    
    public function data_jembatan_count()
    {
        return DataJembatan::count();
    }

    public function data_irigasi_total()
    {
        $data = DataIrigasi::all();

        $areal = 0;
        $saluran_2nd = 0;
        $pintu_air = 0;
        $intake = 0;

        foreach ($data as $key => $value) {
            $areal += $value->areal;
            $saluran_2nd += $value->panjang_saluran_sekunder;
            $pintu_air += $value->bangunan_utama_pintu_air;
            $intake += $value->bangunan_utama_intake;
        }

        return [
            'areal' => $areal,
            'saluran_2nd' => $saluran_2nd,
            'pintu_air' => $pintu_air,
            'intake' => $intake
        ];
    }

    public function data_irigasi_by_kecamatan()
    {
        return DataIrigasi::select('id_kecamatan', DB::RAW('sum(areal) as areal'))->groupby('id_kecamatan')->get();
    }

    public function all_data_irigasi()
    {
        return DataIrigasi::all();
    }

    public function all_data_jalan()
    {
        return DataJalan::with('kecamatan')->get();
    }

    public function jumlah_ruas_jalan() 
    {
        return DataJalan::count();
    }

    public function data_kondisi_jalan() 
    {
        $data = DataKondisiJalan::all();

        $beton_b = 0;
        $beton_s = 0;
        $beton_r = 0;
        $beton_rb = 0;

        $aspal_b = 0;
        $aspal_s = 0;
        $aspal_r = 0;
        $aspal_rb = 0;

        $lainnya_b = 0;
        $lainnya_s = 0;
        $lainnya_r = 0;
        $lainnya_rb = 0;

        foreach ($data as $key => $value) {
            if ($value->jenis=="beton") {
                $beton_b += $value->kondisi_b;
                $beton_s += $value->kondisi_s;
                $beton_r += $value->kondisi_r;
                $beton_rb += $value->kondisi_r_b;
            }
            
            if ($value->jenis=="aspal") {
                $aspal_b += $value->kondisi_b;
                $aspal_s += $value->kondisi_s;
                $aspal_r += $value->kondisi_r;
                $aspal_rb += $value->kondisi_r_b;
            }

            if ($value->jenis=="dll") {
                $lainnya_b += $value->kondisi_b;
                $lainnya_s += $value->kondisi_s;
                $lainnya_r += $value->kondisi_r;
                $lainnya_rb += $value->kondisi_r_b;
            }
        }

        return [
            'beton_b' => round($beton_b, 2),
            'beton_s' => round($beton_s,2),
            'beton_r' => round($beton_r,2),
            'beton_rb' => round($beton_rb, 2),
            'aspal_b' => round($aspal_b, 2),
            'aspal_s' => round($aspal_s, 2),
            'aspal_r' => round($aspal_r, 2),
            'aspal_rb' => round($aspal_rb, 2),
            'lainnya_b' => round($lainnya_b, 2),
            'lainnya_s' => round($lainnya_s, 2),
            'lainnya_r' => round($lainnya_r, 2),
            'lainnya_rb' => round($lainnya_rb),
        ];
    }

    public function total_konstruksi_jalan()
    {
        $data = DataJalan::all();

        $beton = 0;
        $aspal = 0;
        $lainnya = 0;
        $total = 0;

        foreach ($data as $key => $value) {
            $beton += $value->type_kons_beton;    
            $aspal += $value->type_kons_aspal;    
            $lainnya += $value->type_kons_dll;    
        }

        return [
            'beton' => round($beton, 2),
            'aspal' => round($aspal, 2),
            'lainnya' => round($lainnya, 2),
            'total' => round($beton + $aspal + $lainnya, 2)
        ];
    }

    public function data_sungai_count()
    {
        return DataSungai::count();
    }

    public function data_sungai_all()
    {
        return DataSungai::all();
    }
    public function data_sungai_per_kali()
    {
        $sungais=DataSungai::all();
        $sungai=array();
        foreach($sungais as $su)
        {
            $sungai[$su->jenis][$su->id]=$su;
            $sungai[$su->jenis][$su->id]['total_panjang']=$su->panjang_sungai_primer + $su->panjang_sungai_sekunder + $su->panjang_sungai_tersier;

        }

        return $sungai;
    }
    public function data_sungai_per_kecamatan()
    {
        $sungais=DataSungai::all();
        $sungai=array();
        $idx=0;
        foreach($sungais as $su)
        {
            $total=$su->panjang_sungai_primer + $su->panjang_sungai_sekunder + $su->panjang_sungai_tersier;
            $kec=explode(',',$su->kecamatan);
            foreach($kec as $kc)
            {
                $sungai[$kc][$idx]=$su;
                $sungai[$kc][$idx]['total']=$total;
            }
            $idx++;
        }

        return $sungai;
    }

    public function data_situ_count()
    {
        return DataSitu::count();
    }

    public function data_situ_all()
    {
        return DataSitu::all();
    }

    public function data_situ_per_kecamatan()
    {
        $situ=DataSitu::select('id_kecamatan',
        DB::RAW('sum(luas_asal) as total_luas_asal'), DB::RAW('sum(luas_sekarang) as total_luas_sekarang'))->groupby('id_kecamatan')->with('kecamatan')->get();

        $data=array();
        foreach($situ as $idx=> $k)
        {
            $data[$k->id_kecamatan]['id_kecamatan']=$k->id_kecamatan;
            $data[$k->id_kecamatan]['total_luas_asal']=$k->total_luas_asal;
            $data[$k->id_kecamatan]['total_luas_sekarang']=$k->total_luas_sekarang;
            $data[$k->id_kecamatan]['nama_kecamatan']=$k->kecamatan->nama_kecamatan;
            $data[$k->id_kecamatan]['lat']=$k->kecamatan->lat;
            $data[$k->id_kecamatan]['lng']=$k->kecamatan->lng;
        }

        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $data_situ=array();
        $x=0;
        foreach($kecamatan as $kec)
        {
            if(isset($data[$kec->id]))
                $data_situ[$x]=$data[$kec->id];
            else
            {
                $data_situ[$x]['id_kecamatan']=$kec->id;
                $data_situ[$x]['total_luas_sekarang']=0;
                $data_situ[$x]['total_luas_asal']=0;
                $data_situ[$x]['nama_kecamatan']=$kec->nama_kecamatan;
                $data_situ[$x]['lat']=$kec->lat;
                $data_situ[$x]['lng']=$kec->lng;
            }

            $x++;
        }
        return $data_situ; 
    }
}
