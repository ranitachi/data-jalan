<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\DataJalan;
use App\Models\DataJembatan;
use App\Models\DataSitu;
use App\Models\DataIrigasi;
use App\Models\DataKondisiJalan;
use App\Models\DataSungai;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use File;
class DataJalanController extends Controller
{
    public function datajalan($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        // dd($kecm);

        // $dj=DataJalan::all();
        $dj=DataJalan::where('id_kecamatan',$kecm->id)->get();
        $dkj=DataKondisiJalan::all();
        $kondisi=$sumkond=$datajalan=array();
        foreach($dkj as $k=>$v)
        {
            $kondisi[$v->id_data_jalan][$v->jenis][$v->kondisi_b]=$v;
            $sumkond[$v->id_data_jalan][$v->jenis]['b']=$v->kondisi_b;
            $sumkond[$v->id_data_jalan][$v->jenis]['s']=$v->kondisi_s;
            $sumkond[$v->id_data_jalan][$v->jenis]['r']=$v->kondisi_r;
            $sumkond[$v->id_data_jalan][$v->jenis]['rb']=$v->kondisi_r_b;
            $sumkond[$v->id_data_jalan]['persetase']=$v->persentase_rusak;
        }
        // dd($sumkond);
        $beton=$aspal=$dll=$all_kondisi=array();
        foreach($dj as $idj=>$vdj)
        {
            if(isset($kondisi[$vdj->id]))
            {
                $beton[]=$vdj->type_kons_beton;
                $aspal[]=$vdj->type_kons_aspal;
                $dll[]=$vdj->type_kons_dll;
                // $all_kondisi['beton']['b']=array_sum($sumkond[$vdj->id]['beton']['b']);
                // $all_kondisi['beton']['b']=$sumkond[$vdj->id]['beton']['b'];
                foreach($sumkond[$vdj->id]['beton'] as $id_beton=> $j_beton)
                {
                    $all_kondisi['beton'][$id_beton][]=$j_beton;
                }
                foreach($sumkond[$vdj->id]['aspal'] as $id_aspal=> $j_aspal)
                {
                    $all_kondisi['aspal'][$id_aspal][]=$j_aspal;
                }
                foreach($sumkond[$vdj->id]['dll'] as $id_dll=> $j_dll)
                {
                    $all_kondisi['dll'][$id_dll][]=$j_dll;
                }
            }
        }
        $grafik['beton']=$beton;
        $grafik['aspal']=$aspal;
        $grafik['dll']=$dll;

        $jlh['beton']['b']=number_format(array_sum($all_kondisi['beton']['b']),2);
        $jlh['beton']['s']=number_format(array_sum($all_kondisi['beton']['s']),2);
        $jlh['beton']['r']=number_format(array_sum($all_kondisi['beton']['r']),2);
        $jlh['beton']['rb']=number_format(array_sum($all_kondisi['beton']['rb']),2);
        $jlh['aspal']['b']=number_format(array_sum($all_kondisi['aspal']['b']),2);
        $jlh['aspal']['s']=number_format(array_sum($all_kondisi['aspal']['s']),2);
        $jlh['aspal']['r']=number_format(array_sum($all_kondisi['aspal']['r']),2);
        $jlh['aspal']['rb']=number_format(array_sum($all_kondisi['aspal']['rb']),2);
        $jlh['dll']['b']=number_format(array_sum($all_kondisi['dll']['b']),2);
        $jlh['dll']['s']=number_format(array_sum($all_kondisi['dll']['s']),2);
        $jlh['dll']['r']=number_format(array_sum($all_kondisi['dll']['r']),2);
        $jlh['dll']['rb']=number_format(array_sum($all_kondisi['dll']['rb']),2);
        // dd(array_sum($all_kondisi['beton']['b']));
        return view('frontend.pages.data-jalan.detail')
            ->with('kecm',$kecm)
            ->with('jlh',$jlh)
            ->with('all_kondisi',$all_kondisi)
            ->with('grafik',$grafik)
            ->with('kecamatan',$kecamatan)
            ->with('kec',$kec);
    }
    public function dataruasjalan($dataruas)
    {
        $no_ruas=str_replace('Ruas','',$dataruas);
        // $datajalan=DataJalan::where('no_ruas',$no_ruas)->with('kecamatan')->first();
        $dj=DataJalan::with('kecamatan')->get();
        $datajalan=$djalan=array();

        $idkec=-1;
        foreach($dj as $k=>$v)
        {
            if($no_ruas==$v->no_ruas)
            {
                $idkec=$v->id_kecamatan;
                $datajalan=$v;
            }
            else
                $djalan[$v->id_kecamatan][$v->id]=$v;

        }
        // dd($datajalan);
        $kecm=Kecamatan::where('id',$idkec)->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $kec=$kecm->nama_kecamatan;
        return view('frontend.pages.data-jalan.ruas')
            ->with('kecm',$kecm)
            ->with('kec',$kec)
            ->with('idkec',$idkec)
            ->with('kecamatan',$kecamatan)
            ->with('djalan',$djalan[$idkec])
            ->with('datajalan',$datajalan);
    }
    public function jumlahruasjalan($kec)
    {
        $kec=str_replace('%20',' ',$kec);
        $kc=strtoupper($kec);
        $kecm=Kecamatan::where('nama_kecamatan','like',"$kc")->first();
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        // dd($kecm);

        // $dj=DataJalan::all();
        $dj=DataJalan::where('id_kecamatan',$kecm->id)->get();
        
        $dkj=DataKondisiJalan::all();
        $kondisi=$sumkond=$datajalan=array();
        foreach($dkj as $k=>$v)
        {
            $kondisi[$v->id_data_jalan][$v->jenis][$v->kondisi_b]=$v;
            $sumkond[$v->id_data_jalan][$v->jenis]['b']=$v->kondisi_b;
            $sumkond[$v->id_data_jalan][$v->jenis]['s']=$v->kondisi_s;
            $sumkond[$v->id_data_jalan][$v->jenis]['r']=$v->kondisi_r;
            $sumkond[$v->id_data_jalan][$v->jenis]['rb']=$v->kondisi_r_b;
            $sumkond[$v->id_data_jalan]['persetase']=$v->persentase_rusak;
        }
        // dd($sumkond);
        $beton=$aspal=$dll=array();
        foreach($dj as $idj=>$vdj)
        {
            if(isset($kondisi[$vdj->id]))
            {
                $beton[]=$vdj->type_kons_beton;
                $aspal[]=$vdj->type_kons_aspal;
                $dll[]=$vdj->type_kons_dll;
            }
        }
        $grafik['beton']=$beton;
        $grafik['aspal']=$aspal;
        $grafik['dll']=$dll;
        $total= array_sum($beton) + array_sum($aspal) + array_sum($dll);

        $djemb=DataJembatan::where('id_kecamatan',$kecm->id)->whereNotNull('no_jembatan')->get();
        $jlhjembatan=$djemb->count();
        
        $dirg=DataIrigasi::where('id_kecamatan',$kecm->id)->get();
        $jlhirigasi=$dirg->count();
        
        $dsitu=DataSitu::where('id_kecamatan',$kecm->id)->get();
        $jlhsitu=$dsitu->count();
        
        $dsungai=DataSungai::where('kecamatan','like',"%$kecm->nama_kecamatan%")->get();
        $jlhsungai=$dsungai->count();

        return response()->json([
            "status"    => true,
            "verified"  => number_format($total,2),
            "jlhjembatan"  => $jlhjembatan,
            "jlhsitu"  => $jlhsitu,
            "jlhirigasi"  => $jlhirigasi,
            "jlhsungai"  => $jlhsungai,
            "data"      => array()
        ], 200);
    }
    public function load_data()
    {
        $results = Excel::load(storage_path('master/data-jalan.xlsx'))->toObject();
        // echo count($results);
        $kecamatan=Kecamatan::orderBy('nama_kecamatan')->get();
        $kec=array();
        foreach($kecamatan as $k)
        {
            $kec[strtolower(str_slug($k->nama_kecamatan))]=$k;
        }


        $dt=$det=array();
        $x=0;
        foreach($results as $data)
        {
            $kc=strtolower(str_slug($data->kecamatan));
            if(isset($kec[$kc]))
            {
                $d_kec=$kec[$kc];
                // $dt[$d->kecamatan][]=$d;
                $d_jalan=DataJalan::create([
                    'id_kecamatan' => $d_kec->id,
                    'nama_jalan' => $data->nama_jalan,
                    'no_ruas' => $data->no_ruas,
                    'vol_panjang_km' => $data->panjang_km=='-' ? 0 : $data->panjang_km,
                    'vol_lebar_m' => $data->lebar_m=='-' ? 0 : $data->lebar_m,
                    'luas_jalan_m_2' => $data->luas_m_2=='-' ? 0 : $data->luas_m_2,
                    'type_kons_beton' => $data->beton_km=='-' ? 0 :  $data->beton_km,
                    'type_kons_aspal' => $data->aspal_km =='-' ? 0 :  $data->aspal_km,
                    'type_kons_dll' => $data->dll_km=='-' ? 0 : $data->dll_km,
                    'keterangan' => $data->keterangan
                ]);

                $beton['id_data_jalan']=$d_jalan->id;
                $beton['kondisi_b']=$data->beton_b=='-' ? 0 : $data->beton_b;
                $beton['kondisi_s']=$data->beton_s=='-' ? 0 : $data->beton_s;
                $beton['kondisi_r']=$data->beton_r=='-' ? 0 : $data->beton_r;
                $beton['kondisi_r_b']=$data->beton_rb=='-' ? 0 : $data->beton_rb;
                $beton['persentase_rusak']=$data->persentase;
                $beton['jenis']='beton';
                DataKondisiJalan::create($beton);

                $aspal['id_data_jalan']=$d_jalan->id;
                $aspal['kondisi_b']=$data->aspal_b=='-' ? 0 : $data->aspal_b;
                $aspal['kondisi_s']=$data->aspal_s=='-' ? 0 : $data->aspal_s;
                $aspal['kondisi_r']=$data->aspal_r=='-' ? 0 : $data->aspal_r;
                $aspal['kondisi_r_b']=$data->aspal_rb=='-' ? 0 : $data->aspal_rb;
                $aspal['persentase_rusak']=$data->persentase;
                $aspal['jenis']='aspal';
                DataKondisiJalan::create($aspal);
                
                $dll['id_data_jalan']=$d_jalan->id;
                $dll['kondisi_b']=$data->dll_b=='-' ? 0 : $data->dll_b;
                $dll['kondisi_s']=$data->dll_s=='-' ? 0 : $data->dll_s;
                $dll['kondisi_r']=$data->dll_r=='-' ? 0 : $data->dll_r;
                $dll['kondisi_r_b']=$data->dll_rb=='-' ? 0 : $data->dll_rb;
                $dll['persentase_rusak']=$data->persentase;
                $dll['jenis']='dll';
                DataKondisiJalan::create($dll);

                $x++;
            }
        }
        // dd($dt);
    }

    public function upload_kml(Request $request)
    {
        // dd($request->all());
        $id=$request->id_jalan;
        $jalan=DataJalan::find($id);
        $extension = $request->file('file')->getClientOriginalExtension();
        $name='Ruas'.$jalan->no_ruas.'.'.$extension;

        $request->file('file')->move(public_path('kml/data-jalan/'), $name);
        $filepath = public_path('kml/data-jalan').'/'.$name;

        $jalan->kml_file=$name;
        $jalan->save();

        $template=$this->templatekml();

        $alljalan=DataJalan::whereNotNull('kml_file')->get();
        $isikml='';
        foreach($alljalan as $kam=>$pret)
        {
            if($pret->id!=$id)
            {
                $getfile=public_path('kml/data-jalan').'/'.$pret->kml_file;
                $gethtml = File::get($getfile);
                preg_match('/<Placemark>(.*?)<\/Placemark>/s', $gethtml, $getmatch);
                $add_kml='<Folder><name>'.$pret->nama_jalan.'</name><Placemark>'.$getmatch[1].'</Placemark></Folder>';
                $isikml.=$add_kml;
            }
        }

        $html = File::get($filepath);
        // preg_match('/<Placemark>(.*)<\/Placemark>/', $html, $match);
        preg_match('/<Placemark>(.*?)<\/Placemark>/s', $html, $match);
        
        // $html2 = File::get($filepath2);
        $add_text='<Folder><name>'.$jalan->nama_jalan.'</name><Placemark>'.$match[1].'</Placemark></Folder>';
        // $add_text='<Folder><name>'.$jalan->nama_jalan.'</name><Placemark>'.$match[1].'</Placemark></Folder></Document>';
        // $new_text=str_replace('</Document>',$add_text,$html2);

        $new_text=$template['awalan'];
        $new_text.=$isikml;
        $new_text.=$add_text;
        $new_text.=$template['akhiran'];
        
        $filepath2 = public_path('kml/data-jalan').'/Ruas-Jalan.kml';
        $fp = fopen($filepath2, 'w');
        fwrite($fp, $new_text);
        fclose($fp);
        @chmod($filepath2, 0777);

        // Storage::put($filepath2,'kosong');
        // Storage::disk('public_kml')->put('data-jalan/Ruas-Jalan.kml', $new_text);
        // chmod($filepath2,0777);
        // return ($new_text);

        return redirect('all-data-jalan')->with('message', 'berhasil mengupdate data File KML baru.');
        // Storage::disk('ftp')->put('data-jalan/'.$name, fopen($filepath, 'r+'));
    }

    public function templatekml()
    {
        $data['awalan']='<?xml version="1.0" encoding="UTF-8"?>
                            <kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">
                                <Document>
                                    <name>Ruas Jalan Kabupaten Tangerang</name>';
        $data['akhiran']='</Document></kml>';
        return $data;
    }

    public function load_maps($id)
    {
        $data['jalan']=$jalan=DataJalan::find($id);
        $data['url']='http://jalan.abrisamedia.com/kml/data-jalan/'.$jalan->kml_file;
        return $data;
        // return view('backend.pages.jalan.map')->with('url', $url)->with('jalan',$jalan);
    }
    public function view_tabular_jalan()
    {
        $data = DataJalan::with('kecamatan')->with('kondisi_jalan')->get();
        return view('frontend.pages.data-jalan.table')->with('data', $data);
    }

    public function json_kml_jalan()
    {
        // $url='http://jalan.abrisamedia.com/kml/data-jalan/';
        $url=asset('kml/data-jalan');
        $jalan=DataJalan::all();
        $data=array();
        $x=0;
        foreach($jalan as $v)
        {
            if($v->kml_file!='')
            {
                $data[$x]['url']=$url.'/'.$v->kml_file;
                $data[$x]['nama_jalan']=$v->nama_jalan;
                $data[$x]['no_ruas']=$v->no_ruas;
                $x++;
            }
        }
        return $data;
    }
}
