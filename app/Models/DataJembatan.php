<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataJembatan extends Model
{
    use SoftDeletes;
    protected $table='data_jembatan';
    protected $fillable=['id_kecamatan','nama_kecamatan','nama_jalan','no_jembatan','no_ruas_jalan','sta_jembatan','vol_panjang_m','vol_lebar_m','vol_bentang','vol_leb','kondisi_b','kondisi_s','kondisi_r','kondisi_rb','penanganan','volume','biaya_total','biaya_pr','biaya_pp','biaya_rehab','biaya_pkt','keterangan','created_at','updated_at','deleted_at'];

    function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan','id_kecamatan');
    }
}
