<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrxBerita;
use App\Models\TrxBeritaKategori;
class TrxBeritaController extends Controller
{
    public function index()
    {
        return view('backend.pages.berita.index');
    }

    public function create()
    {
        $getkategori = TrxBeritaKategori::all();

        return view('backend.pages.berita.create')->with('kategori', $getkategori);
    }
    public function edit($id)
    {
        $getkategori = TrxBeritaKategori::all();
        $berita=TrxBerita::find($id);
        return view('backend.pages.berita.edit')
            ->with('kategori', $getkategori)
            ->with('berita',$berita);
    }

    
}
