<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upk_bkad extends Model
{
    use SoftDeletes;

    protected $table = "trx_upk_bkad";
    
    protected $fillable = [
        'nama','desa','alamat','id_kec','created_at','updated_at','deleted_at'
    ];

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan','id_kec');
    }
}
