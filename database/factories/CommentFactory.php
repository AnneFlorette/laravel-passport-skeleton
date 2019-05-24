<?php

use Faker\Generator as Faker;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Comment;
use App\Ticket;
use App\User;

$factory->define(Comment::class, function (Faker $faker) {
    $users = User::pluck('id')->toArray();
    $tickets = Ticket::pluck('id')->toArray();
    return [
        'content' => $faker->realText(35, 1),
        'user_id' =>$faker->randomElement($users),
        'ticket_id' => $faker->randomElement($tickets),
    ];
});
