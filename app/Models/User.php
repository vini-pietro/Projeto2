<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relacionamento: Um usuário pode ter vários eventos.
     */
    public function events()
    {
        return $this->hasMany(Event::class); // Confirme que há um modelo Event
    }

    /**
     * Relacionamento: Um usuário pode participar de vários grupos.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user'); // Confirme que há um modelo Group
    }

    /**
     * Relacionamento: Um usuário pode receber convites para grupos.
     */
    public function receivedInvitations()
    {
        return $this->hasMany(GroupInvitation::class, 'receiver_id'); // Confirme que há um modelo GroupInvitation
    }

}
