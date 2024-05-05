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
        return $this->belongsTo(DetailSimpanan::class, 'id_detail_simpanan', 'id_detail_simpanan');
    }

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'id_pinjaman', 'id_pinjaman');
    }
    
    public function detail_pinjaman()
    {
        return $this->belongsTo(DetailPinjaman::class, 'id_detail_pinjaman', 'id_detail_pinjaman');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}