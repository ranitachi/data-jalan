<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataSitu;
use App\Models\Kecamatan;

class BackendIrigasiController extends Controller
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
        ]);
        
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
        ]);
        
        $insert = DataSitu::findOrFail($id);
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
        $insert->save();

        return redirect()->route('all-situ.index')->with('message', 'Berhasil mengubah data baru.');
    }

    public function destroy($id)
    {
        $delete = DataSitu::find($id);
        $delete->delete();

        return redirect()->route('all-situ.index')->with('message', 'Berhasil menghapus data.');
    }
}
