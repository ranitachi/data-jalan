<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataJalan;

class BackendDataJalanController extends Controller
{
    public function index()
    {
        $data = DataJalan::with('kecamatan')->get();

        return view('backend.pages.jalan.index')->with('data', $data);
    }
}
