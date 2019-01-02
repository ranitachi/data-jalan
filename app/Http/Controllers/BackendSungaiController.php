<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSungai;
use App\Models\Kecamatan;
use Session;
class BackendSungaiController extends Controller
{
     public function index()
    {
        $data = DataSungai::with('kecamatan')->get();

        // return $data;

        return view('backend.pages.sungai.index')->with('data', $data);
    }

    public function create()
    {
        $kecamatan=Kecamatan::all();
        return view('backend.pages.sungai.create')->with('kecamatan', $kecamatan);
    }
    public function edit($id)
    {
        $kecamatan=Kecamatan::all();
        $sungai=DataSungai::find($id);
        return view('backend.pages.sungai.edit')->with('kecamatan', $kecamatan)->with('sungai',$sungai)->with('id',$id);
    }

    public function store(Request $request)
    {
        $data=$request->all();
        list($idkec,$nmkec)=explode('-',$request->id_kecamatan);
        $data['id_kecamatan']=$idkec;
        $data['kecamatan']=$nmkec;
        unset($data['id_user']);
        DataSungai::create($data);

        Session::flash('message', 'Berhasil Memasukan Data Sungai Baru'); 
        return redirect('all-sungai')->with('message','Berhasil Memasukan Data Sungai Baru');
        // return $data;
    }
    public function update(Request $request,$id)
    {
        $data=$request->all();
        list($idkec,$nmkec)=explode('-',$request->id_kecamatan);
        $data['id_kecamatan']=$idkec;
        $data['kecamatan']=$nmkec;
        unset($data['id_user']);
        unset($data['_token']);
        unset($data['_method']);
        DataSungai::where('id',$id)->update($data);

        Session::flash('message', 'Berhasil Memperbaharui Data Sungai Baru'); 
        return redirect('all-sungai')->with('message','Berhasil Memperbaharui Data Sungai Baru');
        // return $data;
    }

    public function destroy($id)
    {
        DataSungai::find($id)->delete();
        Session::flash('message', 'Hapus Data Sungai Berhasil'); 
        return redirect('all-sungai')->with('message','Hapus Data Sungai Berhasil');
    }
}
