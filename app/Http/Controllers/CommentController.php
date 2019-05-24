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
    //fonction pour GET 1 commentaire en utilisant son id
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json([
            $comment
        ]);
    }

    //fonction pour GET tous les commentaires
    public function index()
    {
        return response()->json([
            'Comment' => Comment::all()
        ]);
    }

    //fonction POST pour ajouter 1 commentaire
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

    //fonction PUT pour modifier 1 ou plusieurs données d'un commentaire en utilisant son id
    public function update(UpdateCommentRequest $request, $id)
    {
        $input = (object) $request->validated();
        $comment = Comment::findOrFail($id);

        $comment->content = $input->content;
        $comment->save();
        return response(null, '204');
    }

    //fonction DELETE pour supprimer 1 commentaire en utilisant son id
    public function delete(DestroyCommentRequest $request, $id)
    {
        $input = (object) $request->validated();
        $comment = Comment::findOrFail($id);

        $comment->delete();
        return response(null, '204');
    }

}
