<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'location', 'description', 'owner_id'];

    // Define o dono do grupo
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relacionamento com os usuários do grupo (muitos-para-muitos)
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    // Relacionamento com os convites do grupo (um-para-muitos)
    public function invitations()
    {
        return $this->hasMany(GroupInvitation::class);
    }

    // Adicionando a relação com eventos (um grupo pode ter muitos eventos)
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
