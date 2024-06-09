<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'bidang_perusahaan';

    protected $fillable = [
        'bidang' ,'is_disabled', 'create_by'
    ];


    public function perusahaan(){
        return $this->hasMany(Perusahaan::class, 'bidang_perusahaan_id', 'id');
    }


}
