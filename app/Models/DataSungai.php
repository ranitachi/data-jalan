<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataSungai extends Model
{
    use SoftDeletes;
    protected $table='data_sungai';
    protected $fillable=['nama_sungai','areal','jenis','kecamatan','id_kecamatan','panjang_sungai_primer','panjang_sungai_sekunder','panjang_sungai_tersier','bangunan_utama_bendung','bangunan_utama_pintu_air','bangunan_utama_bagi_sadap','bangunan_terlengkap_box_tersier','bangunan_terlengkap_box_gorong','bangunan_terlengkap_box_jembatan','saluran_bendung','saluran_tanah','sudah_dibangun_bendung','sudah_dibangun_pintu_air','sudah_dibangun_bagi_sadap','sudah_dibangun_box_tersier','sudah_dibangun_gorong','sudah_dibangun_jembatan','sudah_dibangun_pasangan','sudah_dibangun_tanah','sisa','keterangan','created_at','updated_at','deleted_at'];
}
