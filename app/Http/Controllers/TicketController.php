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

class TicketController extends BaseController
{
    public function show($id)
    {
        $ticket = Ticket::findorfail($id);
        return response()->json([
            'title' => $ticket->title,
            'content' => $ticket->content,
            'state' => $ticket->state,
            'priority'=> $ticket->priority,
            'last_assignation'=> $ticket->last_assignation,
            'id_creator'=> $ticket->id_user,
            'id_user_assigned' => $ticket->id_user_assigner
        ]);
    }

    public function index()
    {
        return response()->json([
            'ticket' => Ticket::all()
        ]);
    }

    public function create(Request $request)
    {
        $ticket = new Ticket();

        if(($request->input('title') !== null) && ($request->input('priority') !== null) && ($request->input('state') !== null))
        {
            $ticket->title = $request->input('title');
            $ticket->priority = $request->input('priority');
            $ticket->state = Hash::make($request->input('state'));
            $ticket->user_id = auth::user()->id;
            $ticket->content = $request->input('content');
            $ticket->user_id_assigned = User::where('name', $request->input('assigned_email'));
            $ticket->save();
        }
    }


}