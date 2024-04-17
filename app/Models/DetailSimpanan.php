<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSimpanan extends Model
{
    use HasFactory;
    protected $table = 'detail_simpanan';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function simpanan()
    {
        return $this->belongsTo(Simpanan::class, 'id_simpanan', 'id_simpanan');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
