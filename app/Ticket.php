<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;

class Ticket extends Article
{
    use Notifiable, HasApiTokens;

    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = false;
    protected $fillable = ['title', 'content', 'user_id', 'user_id_assigned', 'state', 'priority', 'first_assignation', 'last_assignation'];


    public function comments()
    {
        return $this->HasMany('App\Models\Comment');
    }
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function assigner()
    {
        return $this->belongsTo('App\Models\User', 'user_id_assigned');
    }
}
