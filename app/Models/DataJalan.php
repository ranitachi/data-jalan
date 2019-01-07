<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataJalan extends Model
{
    //
    use SoftDeletes;
    protected $table='data_jalan';
    protected $fillable=['id_kecamatan','nama_jalan','no_ruas','vol_panjang_km','vol_lebar_m',
        'luas_jalan_m_2','type_kons_beton','type_kons_aspal','type_kons_dll','keterangan',
        'foto_1', 'foto_2', 'foto_3',
        'created_at','updated_at','deleted_at'];

    function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan','id_kecamatan');
    }
}
