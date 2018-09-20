<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Struktur_kpm extends Model
{
    use SoftDeletes;

    protected $table = "trx_struktur_kpms";
    
    protected $fillable = [
        'ketua','flag','id_kpm','created_at','updated_at','deleted_at'
    ];

    public function kpm_rt()
    {
        return $this->belongsTo('App\Models\Kpm_rt','id_kpm');
    }
}
