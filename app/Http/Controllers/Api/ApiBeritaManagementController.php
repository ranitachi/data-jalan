<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TrxKatBerita;
use App\Models\TrxBerita;
use Response;
use Session;
class ApiBeritaManagementController extends Controller
{
    public function index()
    {
        $brt=TrxBerita::with('cat_berita')->get();
        $berita=array();
        foreach($brt as $k=>$v)
        {
            $berita[$k]=$v;
            $berita[$k]['desc']=substr(strip_tags($v->desc),0,100);
            if($v->flag==1)
            {
                $berita[$k]['flag']='<span class="label label-primary">Aktif</span>';
            }
            else
            {
                $berita[$k]['flag']='<span class="label label-danger">Tidak Aktif</span>';
            }
        }
        return Response::json([
            "status"    => true,
            "data"      => $berita
        ], 200);
    }

    public function show($id)
    {
        return Response::json([
            "status"    => true,
            "data"      => TrxBerita::find($id)
        ], 200);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validate = $request->validate([
            'id_kategori' => 'required',
            'title' => 'required',
            'file' => 'required',
            'desc' => 'required',
            'id_user' => 'required'      
        ]);

        $insert = new TrxBerita;
        $insert->id_kategori=$request->id_kategori;
        $insert->title=$request->title;
        $insert->file=$request->file;
        $insert->flag=$request->flag;
        $insert->desc=$request->desc;
        $insert->id_user=$request->id_user;
        $insert->slug=str_slug($request->title);
        $insert->save();
        Session::flash('message', 'Berhasil Memasukan Data Berita Baru'); 
        return redirect('berita-admin')->with('message','Berhasil Memasukan Data Berita Baru');
        // return Response::json([
        //     "status"    => true,
        //     "message"   => "berhasil memasukkan data berita baru."
        // ], 200);
    }

    public function update(Request $request)
    {
        $id=$request->id;
        // dd($request->all());
        $validate = $request->validate([
            'id_kategori' => 'required',
            'title' => 'required',
            'file' => 'required',
            'desc' => 'required',
            'id_user' => 'required'      
        ]);

        $insert = TrxBerita::find($id);
        $insert->id_kategori=$request->id_kategori;
        $insert->title=$request->title;
        $insert->file=$request->file;
        $insert->flag=$request->flag;
        $insert->desc=$request->desc;
        $insert->id_user=$request->id_user;
        $insert->slug=str_slug($request->title);
        $insert->save();
        Session::flash('message', 'Berhasil Edit Data Berita'); 
        return redirect('berita-admin')->with('message','Berhasil Edit Data Berita');
    }

    public function destroy($id)
    {
        TrxBerita::find($id)->delete();

        return Response::json([
            "status"    => true,
            "message"   => "berhasil menghapus data."
        ], 200);
    }
}
