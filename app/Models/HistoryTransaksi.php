<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTransaksi extends Model
{
    use HasFactory;
    protected $table = 'history_transaksi';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function detail_simpanan()
    {
        return $this->belongsTo(DetailSimpanan::class, 'id', 'id');
    }

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'id_pinjaman', 'id_pinjaman');
    }

    public function detail_pinjaman()
    {
        return $this->belongsTo(DetailPinjaman::class, 'id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
    
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }
}