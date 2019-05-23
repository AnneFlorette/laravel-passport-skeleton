<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\database\factories\UserFactory;
use App\Http\Middleware\Authenticate as auth;
use App\User;
use App\Ticket;
use App\Comment;

class UserController extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function show($id)
    {
        $user = User::findorfail($id);
        return response()->json([
            $user
        ]);
    }

    public function index()
    {
        return response()->json([
            'user' => User::all()
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();

        if(($request->input('name') !== null)  && ($request->input('email') !== null) && ($request->input('password') !== null))
        {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findorfail($id);

        if(($request->input('name') !== null) && ($request->input('email') !== null) && ($request->input('password') !== null))
        {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }
    }

    public function delete($id)
    {
        $user = User::findorfail($id);

        $user->delete();
    }

    public function emailVerified($id)
    {
        $user = User::findorfail($id);

        $user->email_verified_at = date('Y-m-d H:i:s');
    }
}
