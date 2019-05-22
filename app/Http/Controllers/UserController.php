<?php

namespace App\Http\UserControllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
            'name' => $user->name,
            'email' => $user->email
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

    public function update(Request $request)
    {
        $user = new User();

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
        $ticket = Ticket::where('user_id', $id);
        $comment = Comment::where('user_id', $id);

        $comment->delete();
        $ticket->delete();
        $user->delete();
    }

    public function emailVerified($id)
    {
        $user = new User();

        $user->email_verified_at = date('Y-m-d H:i:s');
    }
}