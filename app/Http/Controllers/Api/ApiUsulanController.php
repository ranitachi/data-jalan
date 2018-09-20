<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Usulan;
use Response;

class ApiUsulanController extends Controller
{
    public function index()
    {
        return Response::json([
            "status"    => true,
            "data"      => Usulan::with('kecamatan')->get()
        ], 200);
    }

    public function show($id)
    {
        return Response::json([
            "status"    => true,
            "data"      => Usulan::find($id)
        ], 200);
    }
}
