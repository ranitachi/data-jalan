<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataJalan;
use App\Models\DataKondisiJalan;
use App\Models\DataIrigasi;
use App\Models\DataJembatan;

use DB;

class ApiForDashboardController extends Controller
{
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
}
