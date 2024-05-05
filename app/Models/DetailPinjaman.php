<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPinjaman extends Model
{
    use HasFactory;
    protected $table = 'detail_pinjaman';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'id_pinjaman', 'id_pinjaman');
    }
    
    public function history_transaksi()
    {
        return $this->belongsTo(HistoryTransaksi::class, 'id_detail_pinjaman', 'id_detail_pinjaman');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}