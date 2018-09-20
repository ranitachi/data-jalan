<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Kecamatan;
use App\Models\Rumahkumuh;
use App\Models\Usulan;
use App\Models\Upk_bkad;
use App\Models\Kpm_rt;
use App\Models\Verified;
class RumahkumuhController extends Controller
{
    public function datakumuh($kecm)
    {
        $kecm=str_replace('%20',' ',$kecm);
        $kec=Kecamatan::all();
        $kc=$verified=$usul=array();
        foreach($kec as $k=>$v)
        {
            $kc[trim(strtolower($v->nama_kecamatan))]=$v;
        }

        $kecm=trim(strtolower($kecm));
        if(isset($kc[$kecm]))
        {
            //$data=Rumahkumuh::where('id_kecamatan',$kc[$kecm]->id)->get();
            $data=Usulan::where('id_kecamatan',$kc[$kecm]->id)->get();
            foreach($data as $kd => $vd)
            {
                $usul[$vd->no_bnba]=$vd;
            }
        }
        else
            $data=array();

        $verif=Verified::all();
        foreach($verif as $kv => $vv)
        {
            if(isset($usul[$vv->no_bnba]))
            {
                $verified[$vv->no_bnba]=$vv;
            }
        }

        // echo count($data);
        return response()->json([
            "status"    => true,
            "verified"    => count($verified),
            "data"      => $data 
        ], 200);
    }
    public function datakumuhjson()
    {
        $kec=Kecamatan::all();
        $kc=array();
        foreach($kec as $k=>$v)
        {
            $kc[$v->id]=$v;
        }

        $dt=Rumahkumuh::all();
        $data=array();
        foreach($dt as $kd => $vd)
        {
            if(isset($kc[$vd->id_kecamatan]))
            {
                $kecm=$kc[$vd->id_kecamatan]->nama_kecamatan;
                $data[$kecm][]=$vd;
            }
        }


        // echo count($data['KOSAMBI']);
        // foreach($data as $key=>$item)
        // {
        //     echo $key.' : '.count($item).'<br>';
        // }
        return response()->json([
            "status"    => true,
            "data"      => $data 
        ], 200);
    }
    public function readcsv()
    {
        $kec=Kecamatan::all();
        $kc=array();
        foreach($kec as $k=>$v)
        {
            $kc[trim($v->nama_kecamatan)]=$v;
        }
        $path=public_path('kecamatan/rumah-kumuh.csv');
        $file=File::get($path);
        $ff=explode("\n",$file);
        // echo count($ff);
        foreach($ff as $key=>$value)
        {
            $dt=explode(',',$value);
            $id=$dt[0];
            $d_kec=$dt[1];
            if(isset($kc[trim($d_kec)]))
                $id_kec=$kc[trim($d_kec)]->id;
            else
                $id_kec=-1;
            $kel=$dt[2];
            $alamat=$dt[3];
            $status=$dt[4];
            $kk=$dt[5];
            echo $id.'-['.$id_kec.']:'.$d_kec.'=='.$kel.'=='.$alamat.'=='.$status.'=='.$kk.'<br>';
        }
    }

    public function detail($kecamatan)
    {
        $kecamatan=str_replace('%20',' ',$kecamatan);
        $kec=strtoupper($kecamatan);

        $d_kec=Kecamatan::where('nama_kecamatan','like',$kec)->first();
        $data_rk=Rumahkumuh::where('id_kecamatan',$d_kec->id)->get();
        $rumah_kumuh=$kelurahan=array();
        foreach($data_rk as $index=>$item)
        {
            $kelurahan[$item->kelurahan]=$item->kelurahan;
        }
        $kecamatan=ucwords($kecamatan);

        $usulan=Usulan::where('id_kecamatan',$d_kec->id)->with('kecamatan')->get();
        $usul=array();
        foreach($usulan as $k =>$v)
        {
            $usul[$v->id_upk_bkad][]=$v;
            
        }

        $upk=Upk_bkad::where('id_kec',$d_kec->id)->with('kecamatan')->get();
        $d_upk=array();
        foreach($upk as $ku => $vu)
        {
            $d_upk[$vu->id]=$vu;
        }

        return view('frontend.pages.dashboard.detail')
            ->with('d_upk',$d_upk)
            ->with('usul',$usul)
            ->with('kelurahan',$kelurahan)
            ->with('kecamatan',$kecamatan);
    }

    public function detailkelurahan($kecamatan,$kel)
    {
        $kecamatan=str_replace('%20',' ',$kecamatan);
        $kel=str_replace('%20',' ',$kel);
        $kec=strtoupper($kecamatan);

        $d_kec=Kecamatan::where('nama_kecamatan','like',$kec)->first();
        $data_rk=Rumahkumuh::where('id_kecamatan',$d_kec->id)->get();
        $rumah_kumuh=$kelurahan=array();
        foreach($data_rk as $index=>$item)
        {
            $kelurahan[$item->kelurahan]=$item->kelurahan;
        }

        $kecamatan=ucwords($kecamatan);
        $usulan=Usulan::where('id_kecamatan',$d_kec->id)->with('kecamatan')->get();
        $usul=array();
        foreach($usulan as $k =>$v)
        {
            $usul[$v->id_upk_bkad][$v->id_kpm][]=$v;
        }

        $upk=Upk_bkad::where('id_kec',$d_kec->id)->get();
        $d_upk=array();
        foreach($upk as $ku => $vu)
        {
            $d_upk[$vu->id]=$vu;
        }
        
        $kpm=Kpm_rt::with('upk_bkad')->get();
        $d_kpm=array();
        foreach($kpm as $ku => $vu)
        {
            $d_kpm[$vu->id_upk_bkad][$vu->id]=$vu;
        }
        return view('frontend.pages.dashboard.detail-kelurahan')
            ->with('d_kpm',$d_kpm)
            ->with('d_upk',$d_upk)
            ->with('usul',$usul)
            ->with('kelurahan',$kelurahan)
            ->with('kell',$kel)
            ->with('kecamatan',$kecamatan);
    }
}
