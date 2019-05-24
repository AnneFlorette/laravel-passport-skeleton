<?php

use Faker\Generator as Faker;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Comment;
use App\User;
use App\Ticket;

$factory->define(Ticket::class, function (Faker $faker) {
    $users = User::pluck('id')->toArray();
    return [
        'title' => $faker->realText(10, 1),
        'content' => $faker->realText(35, 1),
        'priority' => $faker->randomElement([1, 2, 3]),
        'state' => $faker->randomElement(['PENDING', 'WAITING', 'IN_PROGRESS', 'DONE']),
        'user_id' => $faker->unique()->randomElement($users),
        'user_id_assigned' => $faker->unique()->randomElement($users),
        'first_assignation' => now(),
        'last_assignation' => now(),
    ];
});
