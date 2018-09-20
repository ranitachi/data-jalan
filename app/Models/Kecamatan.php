<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use SoftDeletes;

    protected $table = "ref_kecamatan";
    
    protected $fillable = [
        'nama_kecamatan','created_at','updated_at','deleted_at'
    ];

    public function usulan()
    {
        return $this->hasMany('App\Models\Usulan');
    }
}
