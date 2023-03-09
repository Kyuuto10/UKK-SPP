<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';
    protected $fillable = [
        'id_petugas','nisn','nama','id_kelas','alamat','no_telp',
        'tgl_bayar','bulan_dibayar','tahun_dibayar','id_spp','jumlah_bayar'
    ];
}
