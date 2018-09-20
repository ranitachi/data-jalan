<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Response;
use Hash;

class ApiUserManagementController extends Controller
{
    public function index()
    {
        return Response::json([
            "status"    => true,
            "data"      => User::all() 
        ], 200);
    }

    public function show($id)
    {
        return Response::json([
            "status"    => true,
            "data"      => User::find($id) 
        ], 200);
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return Response::json([
            "status"    => true,
            "message"   => "berhasil menghapus data."
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $insert = new User;
        $insert->name = $request->name;
        $insert->email = $request->email;
        $insert->password = Hash::make($request->password);
        $insert->save();

        return Response::json([
            "status"    => true,
            "message"   => "berhasil memasukkan data baru."
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $insert = User::find($id);
        $insert->name = $request->name;
        $insert->save();

        return Response::json([
            "status"    => true,
            "message"   => "berhasil mengubah data."
        ], 200);
    }
}
