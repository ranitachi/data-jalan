<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Struktur_upk extends Model
{
    use SoftDeletes;

    protected $table = "trx_struktur_upks";
    
    protected $fillable = [
        'ketua','sekretaris','bendahara','flag','id_upk_bkad','created_at','updated_at','deleted_at'
    ];

    public function upk_bkad()
    {
        return $this->belongsTo('App\Models\Upk_bkad','id_upk_bkad');
    }
}
