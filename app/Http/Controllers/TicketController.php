<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use App\database\factories\UserFactory;
use Illuminate\Http\Request;
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
            $ticket
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
            $ticket->state = $request->input('state');
            $ticket->user_id = auth::user()->id;
            $ticket->content = $request->input('content');
            $ticket->user_id_assigned = User::where('name', $request->input('assigned_email'));
            $ticket->save();
        }
    }

    public function update(Request $request, $id)
    {
        $ticket = User::findorfail($id);

        if(($request->input('title') !== null) && ($request->input('priority') !== null) && ($request->input('state') !== null))
        {
            $ticket->title = $request->input('title');
            $ticket->priority = $request->input('priority');
            $ticket->state = $request->input('state');
            $ticket->content = $request->input('content');
            $ticket->user_id_assigned = User::where('name', $request->input('assigned_email'));
            $user->save();
        }
    }

    public function delete($id)
    {
        $ticket = User::findorfail($id);

        $ticket->delete();
    }

}
