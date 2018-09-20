<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Verified extends Model
{
    use SoftDeletes;
    
    protected $table = "trx_verified";
    
    protected $fillable = [
        'enumerator', 'tanggal_submit', 'no_bnba', 'jenis_atap', 'kondisi_atap',
        'jenis_bangunan', 'kondisi_bangunan', 'jenis_dinding', 'kondisi_dinding',
        'jenis_kakus', 'kondisi_kakus', 'luas_lahan', 'status_lahan', 'foto_rumah',
        'foto_fisik_bangunan_1', 'foto_fisik_bangunan_2', 'latitude', 'longtitude'
    ];

    public function usulan()
    {
        return $this->belongsTo('App\Models\Usulan', 'no_bnba');
    }
}
