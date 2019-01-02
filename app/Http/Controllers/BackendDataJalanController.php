<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataJalan;
use App\Models\DataKondisiJalan;
use App\Models\Kecamatan;

class BackendDataJalanController extends Controller
{
    public function index()
    {
        $data = DataJalan::with('kecamatan')->get();

        return view('backend.pages.jalan.index')->with('data', $data);
    }

    public function create()
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();

        return view('backend.pages.jalan.create')->with('kecamatan', $kecamatan);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'id_kecamatan' => 'required',
            'no_ruas' => 'required',
            'nama_jalan' => 'required',
            'vol_panjang_km' => 'required|numeric',
            'vol_lebar_m' => 'required|numeric',
            'luas_jalan_m_2' => 'required|numeric',
            'type_kons_beton' => 'required|numeric',
            'type_kons_aspal' => 'required|numeric',
            'type_kons_dll' => 'required|numeric',
            'keterangan' => 'required',
        ]);
        
        $insert = new DataJalan;
        $insert->id_kecamatan = $request->id_kecamatan;
        $insert->no_ruas = $request->no_ruas;
        $insert->nama_jalan = $request->nama_jalan;
        $insert->vol_panjang_km = $request->vol_panjang_km;
        $insert->vol_lebar_m = $request->vol_lebar_m;
        $insert->luas_jalan_m_2 = $request->luas_jalan_m_2;
        $insert->type_kons_beton = $request->type_kons_beton;
        $insert->type_kons_aspal = $request->type_kons_aspal;
        $insert->type_kons_dll = $request->type_kons_dll;
        $insert->keterangan = $request->keterangan;
        $insert->save();

        return redirect()->route('all-data-jalan.index')->with('message', 'Berhasil memasukkan data baru.');
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();
        $data = DataJalan::findOrFail($id);

        return view('backend.pages.jalan.edit')
            ->with('data', $data)
            ->with('kecamatan', $kecamatan);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'id_kecamatan' => 'required',
            'no_ruas' => 'required',
            'nama_jalan' => 'required',
            'vol_panjang_km' => 'required|numeric',
            'vol_lebar_m' => 'required|numeric',
            'luas_jalan_m_2' => 'required|numeric',
            'type_kons_beton' => 'required|numeric',
            'type_kons_aspal' => 'required|numeric',
            'type_kons_dll' => 'required|numeric',
            'keterangan' => 'required',
        ]);
        
        $update = DataJalan::findOrFail($id);
        $update->id_kecamatan = $request->id_kecamatan;
        $update->no_ruas = $request->no_ruas;
        $update->nama_jalan = $request->nama_jalan;
        $update->vol_panjang_km = $request->vol_panjang_km;
        $update->vol_lebar_m = $request->vol_lebar_m;
        $update->luas_jalan_m_2 = $request->luas_jalan_m_2;
        $update->type_kons_beton = $request->type_kons_beton;
        $update->type_kons_aspal = $request->type_kons_aspal;
        $update->type_kons_dll = $request->type_kons_dll;
        $update->keterangan = $request->keterangan;
        $update->save();

        return redirect()->route('all-data-jalan.index')->with('message', 'Berhasil mengubah data.');
    }

    public function destroy($id)
    {
        $delete = DataJalan::find($id);
        $delete->delete();

        return redirect()->route('all-data-jalan.index')->with('message', 'Berhasil menghapus data.');
    }

    public function kondisi($id)
    {
        $kond=array('B'=>'Baik','S'=>'Sedang','R'=>'Rusak','RB'=>'Rusak Berat');
        $type=array('beton'=>'Beton','aspal'=>'Aspal','dll'=>'Lain-Lain');
        $data=DataJalan::where('id',$id)->with('kecamatan')->first();
        $kondisis=DataKondisiJalan::where('id_data_jalan',$id)->get();
        $d_kond=array();
        $persentase=0;
        foreach($kondisis as $kondisi)
        {
            $d_kond[$kondisi->jenis]['B']=$kondisi->kondisi_b;
            $d_kond[$kondisi->jenis]['S']=$kondisi->kondisi_s;
            $d_kond[$kondisi->jenis]['R']=$kondisi->kondisi_r;
            $d_kond[$kondisi->jenis]['RB']=$kondisi->kondisi_r_b;
            $persentase=$kondisi->persentase_rusak;
        }
        return view('backend.pages.jalan.kondisi')
                ->with('data', $data)
                ->with('id', $id)
                ->with('type', $type)
                ->with('kond', $kond)
                ->with('kondisi',$d_kond)
                ->with('persentase',$persentase);
    }
}
