<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\DataJalan;

class ApiBackendDataJalanController extends Controller
{
    public function index()
    {
        $data = DataJalan::all();

        return Response::json([
            "status"    => true,
            "data"      => $data
        ], 200);
    }
}
