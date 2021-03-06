<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataJembatan;
use App\Models\Kecamatan;

use Auth;

class BackendJembatanController extends Controller
{
    public function index()
    {
        $data = DataJembatan::all();

        return view('backend.pages.jembatan.index')->with('data', $data);
    }

    public function create()
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();

        return view('backend.pages.jembatan.create')->with('kecamatan', $kecamatan);
    }

    public function store(Request $request)
    {
        // dd($request);

        $validation = $request->validate([
            'id_kecamatan' => 'required',
            'no_jembatan' => 'required',
            'no_ruas_jalan' => 'required',
            'sta_jembatan' => 'required|numeric',
            'vol_panjang_m' => 'required|numeric',
            'vol_lebar_m' => 'required|numeric',
            'vol_bentang' => 'required|numeric',
            'vol_leb' => 'required|numeric',
            'kondisi' => 'required',
            'penanganan' => 'required',
            'volume' => 'required|numeric',
            'biaya_pr' => 'required|numeric',
            'biaya_pp' => 'required|numeric',
            'biaya_rehab' => 'required|numeric',
            'biaya_pkt' => 'required|numeric',
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

        $path = public_path().'/foto/jembatan/';

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

        $kecamatan = Kecamatan::find($request->id_kecamatan);

        $insert = new DataJembatan;
        $insert->id_kecamatan = $request->id_kecamatan;
        $insert->nama_kecamatan = $kecamatan->nama_kecamatan;
        $insert->no_jembatan = $request->no_jembatan;
        $insert->no_ruas_jalan = $request->no_ruas_jalan;
        $insert->sta_jembatan = $request->sta_jembatan;
        $insert->vol_panjang_m = $request->vol_panjang_m;
        $insert->vol_lebar_m = $request->vol_lebar_m;
        $insert->vol_bentang = $request->vol_bentang;
        $insert->vol_leb = $request->vol_leb;
        $insert->penanganan = $request->penanganan;
        $insert->volume = $request->volume;
        $insert->biaya_pr = $request->biaya_pr;
        $insert->biaya_pp = $request->biaya_pp;
        $insert->biaya_rehab = $request->biaya_rehab;
        $insert->biaya_pkt = $request->biaya_pkt;
        $insert->keterangan = $request->keterangan;
        $insert->foto_1 = $foto_1_save;
        $insert->foto_2 = $foto_2_save;
        $insert->foto_3 = $foto_3_save;

        if ($request->kondisi=="Baik") {
            $insert->kondisi_b = "x";            
        } else if ($request->kondisi=="Sedang") {
            $insert->kondisi_s = "x";            
        } else if ($request->kondisi=="Rusak") {
            $insert->kondisi_r = "x";
        } else if ($request->kondisi=="Rusak Berat") {
            $insert->kondisi_rb = "x";            
        }

        $biaya_total = ($request->biaya_pr + $request->biaya_pp + $request->biaya_rehab + $request->biaya_pkt);
        $insert->biaya_total = $biaya_total;

        $insert->save();

        return redirect()->route('all-jembatan.index')->with('message', 'Berhasil memasukkan data baru.');
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();
        $data = DataJembatan::findOrFail($id);

        return view('backend.pages.jembatan.edit')
            ->with('data', $data)
            ->with('kecamatan', $kecamatan);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'id_kecamatan' => 'required',
            'no_jembatan' => 'required',
            'no_ruas_jalan' => 'required',
            'sta_jembatan' => 'required|numeric',
            'vol_panjang_m' => 'required|numeric',
            'vol_lebar_m' => 'required|numeric',
            'vol_bentang' => 'required|numeric',
            'vol_leb' => 'required|numeric',
            'kondisi' => 'required',
            'penanganan' => 'required',
            'volume' => 'required|numeric',
            'biaya_pr' => 'required|numeric',
            'biaya_pp' => 'required|numeric',
            'biaya_rehab' => 'required|numeric',
            'biaya_pkt' => 'required|numeric',
            'keterangan' => 'required',
            'foto_1' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_2' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_3' => 'mimes:jpg,png,jpeg,gif|nullable',
        ]);

        $foto_1 = $request->file('foto_1');
        $foto_2 = $request->file('foto_2');
        $foto_3 = $request->file('foto_3');

        $path = public_path().'/foto/jembatan/';
        
        $kecamatan = Kecamatan::find($request->id_kecamatan);

        $update = DataJembatan::findOrFail($id);
        $update->id_kecamatan = $request->id_kecamatan;
        $update->nama_kecamatan = $kecamatan->nama_kecamatan;
        $update->no_jembatan = $request->no_jembatan;
        $update->no_ruas_jalan = $request->no_ruas_jalan;
        $update->sta_jembatan = $request->sta_jembatan;
        $update->vol_panjang_m = $request->vol_panjang_m;
        $update->vol_lebar_m = $request->vol_lebar_m;
        $update->vol_bentang = $request->vol_bentang;
        $update->vol_leb = $request->vol_leb;
        $update->penanganan = $request->penanganan;
        $update->volume = $request->volume;
        $update->biaya_pr = $request->biaya_pr;
        $update->biaya_pp = $request->biaya_pp;
        $update->biaya_rehab = $request->biaya_rehab;
        $update->biaya_pkt = $request->biaya_pkt;
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

        if ($request->kondisi=="Baik") {
            $update->kondisi_b = "x";            
        } else if ($request->kondisi=="Sedang") {
            $update->kondisi_s = "x";            
        } else if ($request->kondisi=="Rusak") {
            $update->kondisi_r = "x";
        } else if ($request->kondisi=="Rusak Berat") {
            $update->kondisi_rb = "x";            
        }

        $biaya_total = ($request->biaya_pr + $request->biaya_pp + $request->biaya_rehab + $request->biaya_pkt);
        $update->biaya_total = $biaya_total;

        $update->save();

        return redirect()->route('all-jembatan.index')->with('message', 'Berhasil memasukkan data baru.');
    }

    public function destroy($id)
    {
        $delete = DataJembatan::find($id);
        $delete->delete();

        return redirect()->route('all-jembatan.index')->with('message', 'Berhasil menghapus data.');
    }
}
