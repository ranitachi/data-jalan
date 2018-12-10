<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rumahkumuh;
use App\Models\TrxBerita;
class BeritaController extends Controller
{
    public function index()
    {
        $berita=TrxBerita::orderBy('created_at','desc')->get();
        return view('frontend.pages.berita.index')->with('berita',$berita);
    }
    public function show($id)
    {
        $berita=TrxBerita::where('slug','like',$id)->first();
        $populer=TrxBerita::where('id','!=',$berita->id)->orderBy('view','desc')->orderBy('created_at','desc')->limit(5)->get();
        return view('frontend.pages.berita.detail')
            ->with('berita',$berita)
            ->with('populer',$populer);
    }

    public function detail($slug)
    {
        $berita=TrxBerita::where('slug','like',$slug)->first();
        $berita->view=($berita->view +1);
        $berita->save();

        return redirect('berita/'.$slug);
    }
}
