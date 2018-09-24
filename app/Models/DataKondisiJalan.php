<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataKondisiJalan extends Model
{
    //
    use SoftDeletes;
    protected $table='data_kondisi_jalan';
    protected $fillable=['id_data_jalan','kondisi_b','kondisi_s','kondisi_r','kondisi_r_b','persentase_rusak','jenis','created_at','updated_at','deleted_at'];

    function data_jalan()
    {
        return $this->belongsTo('App\Models\DataJalan','id_data_jalan');
    }
}
