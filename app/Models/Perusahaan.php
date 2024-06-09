<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    protected $fillable = [
        'bidang_perusahaan_id', 'users_id', 'nama_perusahaan',
        'alamat', 'detail_alamat', 'no_telepon', 'email', 'is_disabled'
    ];


    public function bidang_perusahaan(){
        return $this->belongsTo(BidangPerusahaan::class, 'bidang_perusahaan_id', 'id');
    }

    public function akun_perusahaan(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }


}
