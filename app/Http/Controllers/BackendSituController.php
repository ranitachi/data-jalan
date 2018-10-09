<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataSitu;

class BackendSituController extends Controller
{
    public function index()
    {
        $data = DataSitu::with('kecamatan')->with('kelurahan')->get();

        // return $data;

        return view('backend.pages.situ.index')->with('data', $data);
    }
}
