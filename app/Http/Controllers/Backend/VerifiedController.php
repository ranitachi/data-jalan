<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Verified;
use App\Models\Kecamatan;
use App\Models\Usulan;

class VerifiedController extends Controller
{
    public function index()
    {
        return view('backend.pages.verifikasi.index');
    }

    public function show($id)
    {
        $getusulan = Usulan::find($id);

        return view('backend.pages.verifikasi.create')->with('usulan', $getusulan);
    }

    public function create()
    {
        return view('backend.pages.verifikasi.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'enumerator' => 'required',
            'tanggal_submit' => 'required',
            'no_bnba' => 'required',
            'jenis_atap' => 'required',
            'kondisi_atap' => 'required',
            'jenis_bangunan' => 'required',
            'kondisi_bangunan' => 'required',
            'jenis_dinding' => 'required',
            'kondisi_dinding' => 'required',
            'jenis_kakus' => 'required',
            'kondisi_kakus' => 'required',
            'luas_lahan' => 'required|numeric',
            'status_lahan' => 'required',
            'foto_rumah' => 'required',
            'foto_fisik_bangunan_1' => 'required',
            'foto_fisik_bangunan_2' => 'required',
            'latitude' => 'required',
            'longtitude' => 'required',
        ]);
        
        $insert = Verified::create($request->all());

        return redirect()->route('verifikasi.index')->with('message', 'berhasil memasukkan data verifikasi.');
    }

    public function edit($id)
    {
        return view('backend.pages.verifikasi.edit')
            ->with('data', Verified::where('id', $id)->with('usulan')->first());
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'enumerator' => 'required',
            'tanggal_submit' => 'required',
            'no_bnba' => 'required',
            'jenis_atap' => 'required',
            'kondisi_atap' => 'required',
            'jenis_bangunan' => 'required',
            'kondisi_bangunan' => 'required',
            'jenis_dinding' => 'required',
            'kondisi_dinding' => 'required',
            'jenis_kakus' => 'required',
            'kondisi_kakus' => 'required',
            'luas_lahan' => 'required|numeric',
            'status_lahan' => 'required',
            'foto_rumah' => 'required',
            'foto_fisik_bangunan_1' => 'required',
            'foto_fisik_bangunan_2' => 'required',
            'latitude' => 'required',
            'longtitude' => 'required',
        ]);
        
        $update = Verified::find($request->id)->update($request->all());

        return redirect()->route('verifikasi.index')->with('message', 'berhasil mengubah data verifikasi.');
    }

    public function delete($id)
    {
        Verified::find($id)->delete();

        return redirect()->route('verifikasi.index')->with('message', 'berhasil menghapus data verifikasi.');
    }
}
