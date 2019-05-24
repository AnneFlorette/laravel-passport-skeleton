<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use Notifiable;

    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['title', 'content', 'user_id', 'user_id_assigned', 'state', 'priority'];
    protected $casts = [ 'first_assignation' => 'datetime', 'last_assignation' => 'datetime'];

    //RELATIONS

    //Récupère tous les commentaires d'un ticket
    public function comments()
    {
        return $this->HasMany('App\Comment');
    }

    //Récupère le créateur du ticket
    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    //Récupère l'utilisateur assigné du ticket
    public function assigner()
    {
        return $this->belongsTo('App\User', 'user_id_assigned');
    }
}
