<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataJalan;
use App\Models\DataKondisiJalan;

class ApiForDashboardController extends Controller
{
    public function jumlah_ruas_jalan() 
    {
        $data = DataJalan::count();

        return $data;
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
