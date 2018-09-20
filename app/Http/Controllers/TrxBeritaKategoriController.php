<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrxBerita;
use App\Models\TrxBeritaKategori;
class TrxBeritaKategoriController extends Controller
{
    public function index()
    {
        return view('backend.pages.kat-berita.index');
    }
}
