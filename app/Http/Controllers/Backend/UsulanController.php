<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kecamatan;
use App\Models\Usulan;
use App\Models\Upk_bkad;
use App\Models\Kpm_rt;

class UsulanController extends Controller
{
    public function index()
    {
        return view('backend.pages.usulan.index');
    }
    
    public function create()
    {
        $getkecamatan = Kecamatan::all();
        $getupk = Upk_bkad::all();
        $getkpm = Kpm_rt::all();

        return view('backend.pages.usulan.create')
            ->with('upk', $getupk)
            ->with('kpm', $getkpm)
            ->with('kecamatan', $getkecamatan);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'id_kecamatan' => 'required',
            'no_bnba' => 'required',
            'penerima' => 'required',
            'alamat' => 'required',
            'jenis_kegiatan' => 'required',
            'dana_pk_rumah' => 'required|numeric',
            'dana_pemb_wc' => 'required|numeric',
            'dana_bop_keg' => 'required|numeric',
            'id_upk_bkad' => 'required',
            'id_kpm' => 'required',
        ]);

        $dana_total = $request->dana_pk_rumah + $request->dana_pemb_wc + $request->dana_bop_keg;

        $insert = Usulan::find($id);
        $insert->id_kecamatan = $request->id_kecamatan;
        $insert->no_bnba = $request->no_bnba;
        $insert->penerima = $request->penerima;
        $insert->alamat = $request->alamat;
        $insert->jenis_kegiatan = $request->jenis_kegiatan;
        $insert->dana_pk_rumah = $request->dana_pk_rumah;
        $insert->dana_pemb_wc = $request->dana_pemb_wc;
        $insert->dana_bop_keg = $request->dana_bop_keg;
        $insert->dana_total = $dana_total;
        $insert->id_upk_bkad = $request->id_upk_bkad;
        $insert->id_kpm = $request->id_kpm;
        $insert->total_dana = 0;
        $insert->total_unit_rtlh = 0;
        $insert->save();

        return redirect()->route('usulan.index')->with('message', 'berhasil mengupdate data usulan baru.');
    }

    public function edit($id)
    {
        $getusulan = Usulan::find($id);
        $getkecamatan = Kecamatan::all();
        $getupk = Upk_bkad::all();
        $getkpm = Kpm_rt::all();

        return view('backend.pages.usulan.edit')
            ->with('upk', $getupk)
            ->with('kpm', $getkpm)
            ->with('kecamatan', $getkecamatan)
            ->with('data', $getusulan);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_kecamatan' => 'required',
            'no_bnba' => 'required',
            'penerima' => 'required',
            'alamat' => 'required',
            'jenis_kegiatan' => 'required',
            'dana_pk_rumah' => 'required|numeric',
            'dana_pemb_wc' => 'required|numeric',
            'dana_bop_keg' => 'required|numeric',
            'id_upk_bkad' => 'required',
            'id_kpm' => 'required',
        ]);

        $dana_total = $request->dana_pk_rumah + $request->dana_pemb_wc + $request->dana_bop_keg;

        $insert = new Usulan;
        $insert->id_kecamatan = $request->id_kecamatan;
        $insert->no_bnba = $request->no_bnba;
        $insert->penerima = $request->penerima;
        $insert->alamat = $request->alamat;
        $insert->jenis_kegiatan = $request->jenis_kegiatan;
        $insert->dana_pk_rumah = $request->dana_pk_rumah;
        $insert->dana_pemb_wc = $request->dana_pemb_wc;
        $insert->dana_bop_keg = $request->dana_bop_keg;
        $insert->dana_total = $dana_total;
        $insert->id_upk_bkad = $request->id_upk_bkad;
        $insert->id_kpm = $request->id_kpm;
        $insert->total_dana = 0;
        $insert->total_unit_rtlh = 0;
        $insert->save();

        return redirect()->route('usulan.index')->with('message', 'berhasil memasukkan data usulan baru.');
    }

    public function delete($id)
    {
        Usulan::find($id)->delete();

        return redirect()->route('usulan.index')->with('message', 'berhasil menghapus data usulan.');
    }
}
