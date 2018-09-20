<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usulan;
use App\Models\Verified;

class UsulanVerifikasiController extends Controller
{
    public function usulan()
    {
        $getusulan = Usulan::with('kecamatan')->get();

        return view('frontend.pages.usulan.index')->with('data', $getusulan);
    }

    public function verifikasi()
    {
        return view('frontend.pages.verifikasi.index');
    }
}
