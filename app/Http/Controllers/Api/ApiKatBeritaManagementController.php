<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TrxBeritaKategori;
use App\User;
use Response;
use Hash;

class ApiKatBeritaManagementController extends Controller
{
    public function index()
    {
        $d=TrxBeritaKategori::all();
        $data=array();
        foreach($d as $k=>$v)
        {
            $data[$k]=$v;
            if($v->flag==1)
            {
                $data[$k]['flag']='<span class="label label-primary">Aktif</span>';
            }
            else
            {
                $data[$k]['flag']='<span class="label label-danger">Tidak Aktif</span>';
            }
        }
        return Response::json([
            "status"    => true,
            "data"      => $data 
        ], 200);
    }

    public function show($id)
    {
        return Response::json([
            "status"    => true,
            "data"      => TrxBeritaKategori::find($id) 
        ], 200);
    }

    public function destroy($id)
    {
        TrxBeritaKategori::find($id)->delete();

        return Response::json([
            "status"    => true,
            "message"   => "berhasil menghapus data."
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'kategori' => 'required',
            'status' => 'required',        
        ]);

        $insert = new TrxBeritaKategori;
        $insert->nama_kategori = $request->kategori;
        $insert->flag = $request->status;
        $insert->save();

        return Response::json([
            "status"    => true,
            "message"   => "berhasil memasukkan data baru."
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'kategori' => 'required',
            'status' => 'required',
        ]);

        $insert = TrxBeritaKategori::find($id);
        $insert->nama_kategori = $request->kategori;
        $insert->flag = $request->status;
        $insert->save();

        return Response::json([
            "status"    => true,
            "message"   => "berhasil mengubah data."
        ], 200);
    }
}
