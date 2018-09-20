<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kpm_rt extends Model
{
    use SoftDeletes;

    protected $table = "trx_kpm_rt";
    
    protected $fillable = [
        'nama','alamat','id_upk_bkad','created_at','updated_at','deleted_at'
    ];

    public function upk_bkad()
    {
        return $this->belongsTo('App\Models\Upk_bkad','id_upk_bkad');
    }
}

