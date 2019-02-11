<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataSitu;
use App\Models\Kecamatan;

use Auth;

class BackendSituController extends Controller
{
    public function index()
    {
        $data = DataSitu::all();

        return view('backend.pages.situ.index')->with('data', $data);
    }

    public function create()
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();

        return view('backend.pages.situ.create')->with('kecamatan', $kecamatan);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'nama_situ' => 'required',
            'id_kecamatan' => 'required',
            'das' => 'required',
            'luas_asal' => 'required|numeric',
            'luas_sekarang' => 'required|numeric',
            'pengelolaan_pusat' => 'required',
            'pengelolaan_provinsi' => 'required',
            'pengelolaan_kabupaten' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'foto_1' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_2' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_3' => 'mimes:jpg,png,jpeg,gif|nullable',
        ]);

        $foto_1 = $request->file('foto_1');
        $foto_2 = $request->file('foto_2');
        $foto_3 = $request->file('foto_3');

        $foto_1_save = null;
        $foto_2_save = null;
        $foto_3_save = null;

        $path = public_path().'/foto/situ/';

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
        
        $insert = new DataSitu;
        $insert->nama_situ = $request->nama_situ;
        $insert->id_kecamatan = $request->id_kecamatan;
        $insert->das = $request->das;
        $insert->luas_asal = $request->luas_asal;
        $insert->luas_sekarang = $request->luas_sekarang;
        $insert->pengelolaan_pusat = $request->pengelolaan_pusat;
        $insert->pengelolaan_provinsi = $request->pengelolaan_provinsi;
        $insert->pengelolaan_kabupaten = $request->pengelolaan_kabupaten;
        $insert->kondisi = $request->kondisi;
        $insert->keterangan = $request->keterangan;
        $insert->foto_1 = $foto_1_save;
        $insert->foto_2 = $foto_2_save;
        $insert->foto_3 = $foto_3_save;
        $insert->save();

        return redirect()->route('all-situ.index')->with('message', 'Berhasil memasukkan data baru.');
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();
        $data = DataSitu::findOrFail($id);

        return view('backend.pages.situ.edit')
            ->with('data', $data)
            ->with('kecamatan', $kecamatan);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'nama_situ' => 'required',
            'id_kecamatan' => 'required',
            'das' => 'required',
            'luas_asal' => 'required|numeric',
            'luas_sekarang' => 'required|numeric',
            'pengelolaan_pusat' => 'required',
            'pengelolaan_provinsi' => 'required',
            'pengelolaan_kabupaten' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'foto_1' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_2' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_3' => 'mimes:jpg,png,jpeg,gif|nullable',
        ]);

        $foto_1 = $request->file('foto_1');
        $foto_2 = $request->file('foto_2');
        $foto_3 = $request->file('foto_3');

        $path = public_path().'/foto/situ/';
        
        $update = DataSitu::findOrFail($id);
        $update->nama_situ = $request->nama_situ;
        $update->id_kecamatan = $request->id_kecamatan;
        $update->das = $request->das;
        $update->luas_asal = $request->luas_asal;
        $update->luas_sekarang = $request->luas_sekarang;
        $update->pengelolaan_pusat = $request->pengelolaan_pusat;
        $update->pengelolaan_provinsi = $request->pengelolaan_provinsi;
        $update->pengelolaan_kabupaten = $request->pengelolaan_kabupaten;
        $update->kondisi = $request->kondisi;
        $update->keterangan = $request->keterangan;

        if (!is_null($foto_1)) {
            $filename1 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_1->getClientOriginalName());
            $foto_1->move($path, $filename1);
            $update->foto_1 = $filename1;
        }
        if (!is_null($foto_2)) {
            $filename2 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_2->getClientOriginalName());
            $foto_2->move($path, $filename2);
            $update->foto_2 = $filename2;
        }
        if (!is_null($foto_3)) {
            $filename3 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_3->getClientOriginalName());
            $foto_3->move($path, $filename3);
            $update->foto_3 = $filename3;
        }

        $update->save();

        return redirect()->route('all-situ.index')->with('message', 'Berhasil mengubah data baru.');
    }

    public function destroy($id)
    {
        $delete = DataSitu::find($id);
        $delete->delete();

        return redirect()->route('all-situ.index')->with('message', 'Berhasil menghapus data.');
    }
}
