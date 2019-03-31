<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSungai;
use App\Models\Kecamatan;
use Session;
use Auth;

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
        $validation = $request->validate([
            'foto_1' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_2' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_3' => 'mimes:jpg,png,jpeg,gif|nullable',
        ]);

        $data=$request->all();
        list($idkec,$nmkec)=explode('-',$request->id_kecamatan);
        $data['id_kecamatan']=$idkec;
        $data['kecamatan']=$nmkec;
        unset($data['id_user']);

        $foto_1 = $request->file('foto_1');
        $foto_2 = $request->file('foto_2');
        $foto_3 = $request->file('foto_3');

        $foto_1_save = null;
        $foto_2_save = null;
        $foto_3_save = null;

        $path = public_path().'/foto/sungai/';

        if (!is_null($foto_1)) {
            $filename1 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_1->getClientOriginalName());
            $foto_1->move($path, $filename1);
            $foto_1_save = $filename1;
        }
        if (!is_null($foto_2)) {
            $filename2 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_2->getClientOriginalName());
            $foto_2->move($path, $filename2);
            $foto_2_save = $filename2;
        }
        if (!is_null($foto_3)) {
            $filename3 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_3->getClientOriginalName());
            $foto_3->move($path, $filename3);
            $foto_3_save = $filename3;
        }

        $data['foto_1'] = $foto_1_save;
        $data['foto_2'] = $foto_2_save;
        $data['foto_3'] = $foto_3_save;

        DataSungai::create($data);

        Session::flash('message', 'Berhasil Memasukan Data Sungai Baru'); 
        return redirect('all-sungai')->with('message','Berhasil Memasukan Data Sungai Baru');
        // return $data;
    }
    public function update(Request $request,$id)
    {
        $validation = $request->validate([
            'foto_1' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_2' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_3' => 'mimes:jpg,png,jpeg,gif|nullable',
        ]);

        $foto_1 = $request->file('foto_1');
        $foto_2 = $request->file('foto_2');
        $foto_3 = $request->file('foto_3');

        $path = public_path().'/foto/sungai/';

        $data=$request->all();
        list($idkec,$nmkec)=explode('-',$request->id_kecamatan);
        $data['id_kecamatan']=$idkec;
        $data['kecamatan']=$nmkec;
        unset($data['id_user']);
        unset($data['_token']);
        unset($data['_method']);

        if (!is_null($foto_1)) {
            $filename1 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_1->getClientOriginalName());
            $foto_1->move($path, $filename1);
            $data['foto_1'] = $filename1;
        }
        if (!is_null($foto_2)) {
            $filename2 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_2->getClientOriginalName());
            $foto_2->move($path, $filename2);
            $data['foto_2'] = $filename2;
        }
        if (!is_null($foto_3)) {
            $filename3 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_3->getClientOriginalName());
            $foto_3->move($path, $filename3);
            $data['foto_3'] = $filename3;
        }

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
