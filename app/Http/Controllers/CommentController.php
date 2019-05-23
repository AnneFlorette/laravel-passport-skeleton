<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\database\factories\UserFactory;
use App\Http\Middleware\Authenticate as auth;
use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\Comment;

class CommentController extends BaseController
{
    public function show($id)
    {
        $comment = Comment::findorfail($id);
        return response()->json([
            $comment

        ]);
    }

    public function index()
    {
        return response()->json([
            'Comment' => Comment::all()
        ]);
    }

    public function create(Request $request)
    {
        $comment = new Comment();

        if(($comment->input('content') !== null))
        {
            $comment->content = $request->input('content');
            $comment->ticket_id = $request->input('ticket_id');
            $comment->user_id = auth::user()->id;
            $comment->save();
        }
    }

    public function update(Request $request, $id)
    {
        $comment = User::findorfail($id);

        if(($comment->input('content') !== null))
        {
            $comment->content = $request->input('content');
            $comment->save();
        }
    }

    public function delete($id)
    {
        $comment = Comment::findorfail($id);

        $comment->delete();
    }

}
