<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataIrigasi;

class BackendIrigasiController extends Controller
{
    public function index()
    {
        $data = DataIrigasi::all();

        return view('backend.pages.irigasi.index')->with('data', $data);
    }
}
