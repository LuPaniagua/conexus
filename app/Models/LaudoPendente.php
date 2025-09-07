<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaudoPendente extends Model
{
    use HasFactory;

    // 👇 Adicione esta linha
    protected $table = 'laudos_pendentes';

    protected $fillable = [
        'user_id',
        'sala_id',
        'caminho_arquivo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Sala::class, 'sala_id');
    }

    public function sala()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
