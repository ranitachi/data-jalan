<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Response;
use App\User;
use Hash;

class ApiChangePasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required|confirmed',
            'new_pass_confirmation' => 'required',
        ]);

        $update = User::find($request->id_user);

        if (Hash::check($request->old_pass, $update->password)) {
            $update->password = Hash::make($request->new_pass);
            $update->save();
        } else {
            return Response::json([
                'status'    => false
            ], 500);
        }

        return Response::json([
            'status'    => true,
            'message'   => "berhasil mengganti password.",
            'data'      => $update
        ], 200);
    }
}
