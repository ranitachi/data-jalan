<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataIrigasi;
use App\Models\Kecamatan;

class BackendIrigasiController extends Controller
{
    public function index()
    {
        $data = DataIrigasi::all();

        return view('backend.pages.irigasi.index')->with('data', $data);
    }

    public function create()
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();

        return view('backend.pages.irigasi.create')->with('kecamatan', $kecamatan);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'daerah_irigasi' => 'required',
            'id_kecamatan' => 'required',
            'areal' => 'required|numeric',
            'panjang_saluran_primer' => 'required|numeric',
            'panjang_saluran_sekunder' => 'required|numeric',
            'panjang_saluran_tersier' => 'required|numeric',
            'bangunan_utama_gedung' => 'required|numeric',
            'bangunan_utama_pintu_air' => 'required|numeric',
            'bangunan_utama_intake' => 'required|numeric',
            'pelengkap_box_tersier' => 'required|numeric',
            'pelengkap_gorong' => 'required|numeric',
            'pelengkap_jembatan' => 'required|numeric',
            'sumber_air' => 'required',
        ]);
        
        $insert = new DataIrigasi;
        $insert->daerah_irigasi = $request->daerah_irigasi;
        $insert->id_kecamatan = $request->id_kecamatan;
        $insert->areal = $request->areal;
        $insert->panjang_saluran_primer = $request->panjang_saluran_primer;
        $insert->panjang_saluran_sekunder = $request->panjang_saluran_sekunder;
        $insert->panjang_saluran_tersier = $request->panjang_saluran_tersier;
        $insert->bangunan_utama_gedung = $request->bangunan_utama_gedung;
        $insert->bangunan_utama_pintu_air = $request->bangunan_utama_pintu_air;
        $insert->bangunan_utama_intake = $request->bangunan_utama_intake;
        $insert->pelengkap_box_tersier = $request->pelengkap_box_tersier;
        $insert->pelengkap_gorong = $request->pelengkap_gorong;
        $insert->pelengkap_jembatan = $request->pelengkap_jembatan;
        $insert->sumber_air = $request->sumber_air;
        $insert->save();

        return redirect()->route('all-irigasi.index')->with('message', 'Berhasil memasukkan data baru.');
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();
        $data = DataIrigasi::findOrFail($id);

        return view('backend.pages.irigasi.edit')
            ->with('data', $data)
            ->with('kecamatan', $kecamatan);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'daerah_irigasi' => 'required',
            'id_kecamatan' => 'required',
            'areal' => 'required|numeric',
            'panjang_saluran_primer' => 'required|numeric',
            'panjang_saluran_sekunder' => 'required|numeric',
            'panjang_saluran_tersier' => 'required|numeric',
            'bangunan_utama_gedung' => 'required|numeric',
            'bangunan_utama_pintu_air' => 'required|numeric',
            'bangunan_utama_intake' => 'required|numeric',
            'pelengkap_box_tersier' => 'required|numeric',
            'pelengkap_gorong' => 'required|numeric',
            'pelengkap_jembatan' => 'required|numeric',
            'sumber_air' => 'required',
        ]);
        
        $update = DataIrigasi::findOrFail($id);
        $update->daerah_irigasi = $request->daerah_irigasi;
        $update->id_kecamatan = $request->id_kecamatan;
        $update->areal = $request->areal;
        $update->panjang_saluran_primer = $request->panjang_saluran_primer;
        $update->panjang_saluran_sekunder = $request->panjang_saluran_sekunder;
        $update->panjang_saluran_tersier = $request->panjang_saluran_tersier;
        $update->bangunan_utama_gedung = $request->bangunan_utama_gedung;
        $update->bangunan_utama_pintu_air = $request->bangunan_utama_pintu_air;
        $update->bangunan_utama_intake = $request->bangunan_utama_intake;
        $update->pelengkap_box_tersier = $request->pelengkap_box_tersier;
        $update->pelengkap_gorong = $request->pelengkap_gorong;
        $update->pelengkap_jembatan = $request->pelengkap_jembatan;
        $update->sumber_air = $request->sumber_air;
        $update->save();

        return redirect()->route('all-irigasi.index')->with('message', 'Berhasil mengubah data baru.');
    }

    public function destroy($id)
    {
        $delete = DataIrigasi::find($id);
        $delete->delete();

        return redirect()->route('all-irigasi.index')->with('message', 'Berhasil menghapus data.');
    }
}
