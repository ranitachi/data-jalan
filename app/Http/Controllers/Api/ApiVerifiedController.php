<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Verified;
use Response;

class ApiVerifiedController extends Controller
{
    public function index()
    {
        return Response::json([
            "status"    => true,
            "data"      => Verified::orderby('no_bnba')->with('usulan')->get()
        ], 200);
    }

    public function show($id)
    {
        return Response::json([
            "status"    => true,
            "data"      => Verified::where('id', $id)->with('usulan')->first()
        ], 200);
    }
    
}
