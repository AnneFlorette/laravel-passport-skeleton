<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use Notifiable;

    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['content', 'user_id', 'ticket_id'];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'ticket_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
