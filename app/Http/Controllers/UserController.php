<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\database\factories\UserFactory;
use App\Http\Middleware\Authenticate as auth;

use App\User;
use App\Ticket;
use App\Comment;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\DestroyUserRequest;

class UserController extends BaseController
{

    //fonction pour GET 1 utilisateur en utilisant son id
    public function show($id)
    {
        $user = User::findorfail($id);
        return $user;
    }

    //fonction pour GET tous les utilisateurs
    public function index()
    {
        return response()->json(
            User::all()
        );
    }

    //fonction POST pour ajouter 1 utilisateur
    public function create(Request $request)
    {
        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->remember_token = Str::random(10);
        $user->email_verified_at = now();
        $user->save();
        return response(null, '204');
    }

    //fonction PUT pour modifier 1 ou plusieurs données d'un utilisateur en utilisant son id
    public function update(UpdateUserRequest $request, $id)
    {
        $input = (object) $request->validated();
        $user = User::findorfail($id);

            $user->name = $input->name;
            $user->email = $input->email;
            $user->password = Hash::make($input->password);
            $user->save();
            return response(null, '204');
    }

    //fonction DELETE pour supprimer 1 utilisateur en utilisant son id
    public function delete(DestroyUserRequest $request, $id)
    {
        $input = (object) $request->validated();
        $user = User::findorfail($id);

        $user->delete();
        return response(null, '204');
    }

    //fonction POST pour ajouter dans la base la date à laquelle le mail à été vérifier
    public function emailVerified($id)
    {
        $user = User::findorfail($id);

        $user->email_verified_at = date('Y-m-d H:i:s');
        return response(null, '204');
    }
}
