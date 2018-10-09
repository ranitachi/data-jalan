<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes;

    protected $table = "ref_kelurahan";
    
    protected $fillable = [
        'id_kecamatan','nama_kelurahan','created_at','updated_at','deleted_at'
    ];

    public function kecamatan()
    {
        return $this->hasMany('App\Models\Kecamatan');
    }
}
