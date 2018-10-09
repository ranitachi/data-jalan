<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataSitu extends Model
{
    use SoftDeletes;
    protected $table='data_situ';
    protected $fillable=['nama_situ','id_kecamatan','id_kelurahan','das','luas_asal','luas_sekarang','pengelolaan_pusat','pengelolaan_provinsi','pengelolaan_kabupaten','kondisi','keterangan','created_at','updated_at','deleted_at'];

    function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan','id_kecamatan');
    }
    function kelurahan()
    {
        return $this->belongsTo('App\Models\Kelurahan','id_kelurahan');
    }
}
