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
    protected $fillable = ['title', 'content', 'user_id', 'user_id_assigned', 'state', 'priority', 'first_assignation', 'last_assignation'];


    public function comments()
    {
        return $this->HasMany('App\Comment');
    }
    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function assigner()
    {
        return $this->belongsTo('App\User', 'user_id_assigned');
    }
}
