<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataJalan;
use App\Models\DataKondisiJalan;
use App\Models\Kecamatan;

use Auth;

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
            'kondisi_beton_b' => 'required|numeric',
            'kondisi_beton_s' => 'required|numeric',
            'kondisi_beton_r' => 'required|numeric',
            'kondisi_beton_rb' => 'required|numeric',
            'kondisi_aspal_b' => 'required|numeric',
            'kondisi_aspal_s' => 'required|numeric',
            'kondisi_aspal_r' => 'required|numeric',
            'kondisi_aspal_rb' => 'required|numeric',
            'kondisi_lainnya_b' => 'required|numeric',
            'kondisi_lainnya_s' => 'required|numeric',
            'kondisi_lainnya_r' => 'required|numeric',
            'kondisi_lainnya_rb' => 'required|numeric',
            'persentase_rusak' => 'required|numeric',
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

        $path = public_path().'/foto/jalan/';

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
        
        $insertjalan = new DataJalan;
        $insertjalan->id_kecamatan = $request->id_kecamatan;
        $insertjalan->no_ruas = $request->no_ruas;
        $insertjalan->nama_jalan = $request->nama_jalan;
        $insertjalan->vol_panjang_km = $request->vol_panjang_km;
        $insertjalan->vol_lebar_m = $request->vol_lebar_m;
        $insertjalan->luas_jalan_m_2 = $request->luas_jalan_m_2;
        $insertjalan->type_kons_beton = $request->type_kons_beton;
        $insertjalan->type_kons_aspal = $request->type_kons_aspal;
        $insertjalan->type_kons_dll = $request->type_kons_dll;
        $insertjalan->keterangan = $request->keterangan;
        $insertjalan->foto_1 = $foto_1_save;
        $insertjalan->foto_2 = $foto_2_save;
        $insertjalan->foto_3 = $foto_3_save;
        $insertjalan->save();

        // insert data kondisi jalan
        $insert = new DataKondisiJalan;
        $insert->id_data_jalan = $insertjalan->id;
        $insert->jenis = "beton";
        $insert->kondisi_b = $request->kondisi_beton_b;
        $insert->kondisi_s = $request->kondisi_beton_s;
        $insert->kondisi_r = $request->kondisi_beton_r;
        $insert->kondisi_r_b = $request->kondisi_beton_rb;
        $insert->persentase_rusak = $request->persentase_rusak;
        $insert->save();

        $insert = new DataKondisiJalan;
        $insert->id_data_jalan = $insertjalan->id;
        $insert->jenis = "aspal";
        $insert->kondisi_b = $request->kondisi_aspal_b;
        $insert->kondisi_s = $request->kondisi_aspal_s;
        $insert->kondisi_r = $request->kondisi_aspal_r;
        $insert->kondisi_r_b = $request->kondisi_aspal_rb;
        $insert->persentase_rusak = $request->persentase_rusak;
        $insert->save();

        $insert = new DataKondisiJalan;
        $insert->id_data_jalan = $insertjalan->id;
        $insert->jenis = "dll";
        $insert->kondisi_b = $request->kondisi_lainnya_b;
        $insert->kondisi_s = $request->kondisi_lainnya_s;
        $insert->kondisi_r = $request->kondisi_lainnya_r;
        $insert->kondisi_r_b = $request->kondisi_lainnya_rb;
        $insert->persentase_rusak = $request->persentase_rusak;
        $insert->save();

        return redirect()->route('all-data-jalan.index')->with('message', 'Berhasil memasukkan data baru.');
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::orderby('nama_kecamatan')->get();
        $data = DataJalan::findOrFail($id);
        $kondisi = DataKondisiJalan::where('id_data_jalan', $id)->get();

        $beton = [];
        $aspal = [];
        $lainnya = [];

        foreach ($kondisi as $value) {
            if ($value->jenis=="beton") {
                $beton['baik'] = $value->kondisi_b;
                $beton['sedang'] = $value->kondisi_s;
                $beton['rusak'] = $value->kondisi_r;
                $beton['rusak_berat'] = $value->kondisi_r_b;
                $beton['persen'] = $value->persentase_rusak;
            }

            if ($value->jenis=="aspal") {
                $aspal['baik'] = $value->kondisi_b;
                $aspal['sedang'] = $value->kondisi_s;
                $aspal['rusak'] = $value->kondisi_r;
                $aspal['rusak_berat'] = $value->kondisi_r_b;
                $aspal['persen'] = $value->persentase_rusak;
            }

            if ($value->jenis=="dll") {
                $lainnya['baik'] = $value->kondisi_b;
                $lainnya['sedang'] = $value->kondisi_s;
                $lainnya['rusak'] = $value->kondisi_r;
                $lainnya['rusak_berat'] = $value->kondisi_r_b;
                $lainnya['persen'] = $value->persentase_rusak;
            }
        }

        return view('backend.pages.jalan.edit')
            ->with('data', $data)
            ->with('beton', $beton)
            ->with('aspal', $aspal)
            ->with('lainnya', $lainnya)
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
            'kondisi_beton_b' => 'required|numeric',
            'kondisi_beton_s' => 'required|numeric',
            'kondisi_beton_r' => 'required|numeric',
            'kondisi_beton_rb' => 'required|numeric',
            'kondisi_aspal_b' => 'required|numeric',
            'kondisi_aspal_s' => 'required|numeric',
            'kondisi_aspal_r' => 'required|numeric',
            'kondisi_aspal_rb' => 'required|numeric',
            'kondisi_lainnya_b' => 'required|numeric',
            'kondisi_lainnya_s' => 'required|numeric',
            'kondisi_lainnya_r' => 'required|numeric',
            'kondisi_lainnya_rb' => 'required|numeric',
            'persentase_rusak' => 'required|numeric',
            'foto_1' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_2' => 'mimes:jpg,png,jpeg,gif|nullable',
            'foto_3' => 'mimes:jpg,png,jpeg,gif|nullable',
        ]);

        $foto_1 = $request->file('foto_1');
        $foto_2 = $request->file('foto_2');
        $foto_3 = $request->file('foto_3');

        $path = public_path().'/foto/jalan/';
        
        $updatejalan = DataJalan::findOrFail($id);
        $updatejalan->id_kecamatan = $request->id_kecamatan;
        $updatejalan->no_ruas = $request->no_ruas;
        $updatejalan->nama_jalan = $request->nama_jalan;
        $updatejalan->vol_panjang_km = $request->vol_panjang_km;
        $updatejalan->vol_lebar_m = $request->vol_lebar_m;
        $updatejalan->luas_jalan_m_2 = $request->luas_jalan_m_2;
        $updatejalan->type_kons_beton = $request->type_kons_beton;
        $updatejalan->type_kons_aspal = $request->type_kons_aspal;
        $updatejalan->type_kons_dll = $request->type_kons_dll;
        $updatejalan->keterangan = $request->keterangan;

        if (!is_null($foto_1)) {
            $filename1 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_1->getClientOriginalName());
            $foto_1->move($path, $filename1);
            $updatejalan->foto_1 = $filename1;
        }
        if (!is_null($foto_2)) {
            $filename2 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_2->getClientOriginalName());
            $foto_2->move($path, $filename2);
            $updatejalan->foto_2 = $filename2;
        }
        if (!is_null($foto_3)) {
            $filename3 = time()."_"."authorid".Auth::user()->id."_".strtolower($foto_3->getClientOriginalName());
            $foto_3->move($path, $filename3);
            $updatejalan->foto_3 = $filename3;
        }

        $updatejalan->save();

        // insert data kondisi jalan
        $update = DataKondisiJalan::where('id_data_jalan', $id)->where('jenis', 'beton')->first();
        $update->id_data_jalan = $id;
        $update->jenis = "beton";
        $update->kondisi_b = $request->kondisi_beton_b;
        $update->kondisi_s = $request->kondisi_beton_s;
        $update->kondisi_r = $request->kondisi_beton_r;
        $update->kondisi_r_b = $request->kondisi_beton_rb;
        $update->persentase_rusak = $request->persentase_rusak;
        $update->save();

        $update = DataKondisiJalan::where('id_data_jalan', $id)->where('jenis', 'aspal')->first();
        $update->id_data_jalan = $id;
        $update->jenis = "aspal";
        $update->kondisi_b = $request->kondisi_aspal_b;
        $update->kondisi_s = $request->kondisi_aspal_s;
        $update->kondisi_r = $request->kondisi_aspal_r;
        $update->kondisi_r_b = $request->kondisi_aspal_rb;
        $update->persentase_rusak = $request->persentase_rusak;
        $update->save();

        $update = DataKondisiJalan::where('id_data_jalan', $id)->where('jenis', 'dll')->first();
        $update->id_data_jalan = $id;
        $update->jenis = "dll";
        $update->kondisi_b = $request->kondisi_lainnya_b;
        $update->kondisi_s = $request->kondisi_lainnya_s;
        $update->kondisi_r = $request->kondisi_lainnya_r;
        $update->kondisi_r_b = $request->kondisi_lainnya_rb;
        $update->persentase_rusak = $request->persentase_rusak;
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
