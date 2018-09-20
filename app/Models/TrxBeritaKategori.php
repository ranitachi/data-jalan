<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TrxBeritaKategori extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'trx_berita_kategori';
    protected $fillable = ['nama_kategori', 'desc','flag', 'created_at', 'updated_at'];

    public function berita()
    {
      return $this->hasMany('App\Models\TrxBerita');
    }
}
