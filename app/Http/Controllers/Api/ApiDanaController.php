<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Usulan;
use Response;

class ApiDanaController extends Controller
{
    public function byID($id)
    {
        return Response::json([
            'status'    => true,
            'data'      => Usulan::find($id)
        ], 200);
    }
}
