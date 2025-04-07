<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'user_id', // Criador do evento
    ];

    /**
     * Relacionamento: Um evento pertence a um usuário (criador).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
