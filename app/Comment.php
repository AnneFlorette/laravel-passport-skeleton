<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;

class Comment extends Article
{
    use Notifiable, HasApiTokens;

    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = false;
    protected $fillable = ['content', 'user_id', 'ticket_id'];

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
