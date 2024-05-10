<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function simpanan()
    {
        return $this->hasOne(Simpanan::class, 'id_anggota', 'id_anggota');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'id_anggota', 'id_anggota');
    }

    public function hasSimpanan()
    {
        return $this->simpanan()->exists();
    }

    public function hasPinjaman()
    {
        return $this->pinjaman()->exists();
    }

    public function history_transaksi()
    {
        return $this->hasMany(HistoryTransaksi::class, 'id_anggota', 'id_anggota');
    }
}
