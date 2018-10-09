<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataIrigasi extends Model
{
    use SoftDeletes;
    protected $table='data_irigasi';
    protected $fillable=['daerah_irigasi','id_kecamatan','areal','panjang_saluran_primer','panjang_saluran_sekunder','panjang_saluran_tersier','bangunan_utama_gedung','bangunan_utama_pintu_air','bangunan_utama_intake','pelengkap_box_tersier','pelengkap_gorong','pelengkap_jembatan','sumber_air','created_at','updated_at','deleted_at'];

    function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan','id_kecamatan');
    }

}
