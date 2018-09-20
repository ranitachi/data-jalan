<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rumahkumuh extends Model
{
    use SoftDeletes;

    protected $table = 'trx_rumahkumuh';
    
    protected $fillable = [
        'id_kecamatan', 'alamat', 'status_kesejahteraan', 'nama_kk','created_at','updated_at','deleted_at'
    ];

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan');
    }
}
