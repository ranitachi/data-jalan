<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usulan extends Model
{
    use SoftDeletes;

    protected $table = 'trx_usulan';
    
    protected $fillable = [
        'id_kecamatan', 'no_bnba', 'penerima', 'alamat', 'jenis_kegiatan', 
        'dana_pk_rumah', 'dana_pemb_wc', 'dana_bop_keg', 'dana_total', 'status', 
        'id_upk_bkad', 'id_kpm', 'total_dana', 'total_unit_rtlh'
    ];

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan');
    }

    public function verifikasi()
    {
        return $this->hasOne('App\Models\Verified', 'no_bnba');
    }
    
}
