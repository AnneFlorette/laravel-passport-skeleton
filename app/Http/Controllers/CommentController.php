<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\database\factories\UserFactory;
use Illuminate\Support\Facades\Auth as currentUser;
use App\Http\Middleware\Authenticate as auth;
use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\Comment;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\DestroyCommentRequest;

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

    public function create(CreateCommentRequest $request)
    {
        $input = (object) $request->validated();
        $comment = new Comment();

        $comment->content = $input->content;
        $comment->ticket_id = $input->ticket_id;
        $comment->user_id = currentUser::user()->id;
        $comment->save();
        return response(null, '204');
    }

    public function update(UpdateCommentRequest $request, $id)
    {
        $input = (object) $request->validated();
        $comment = Comment::findorfail($id);

        $comment->content = $input->content;
        $comment->save();
        return response(null, '404');
    }

    public function delete(DestroyCommentRequest $request, $id)
    {
        $input = (object) $request->validated();
        $comment = Comment::findorfail($id);

        $comment->delete();
        return response(null, '204');
    }

}
