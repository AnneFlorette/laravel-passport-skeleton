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

use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

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

    public function create(CreateTicketRequest $request)
    {
        $input = (object) $request->validated();
        $ticket = new Ticket();

            $ticket->title = $input->title;
            $ticket->priority = $input->priority;
            $ticket->state = $input->state;
            $ticket->user_id = auth::user()->id;
            $ticket->content = $input->content;
            $ticket->user_id_assigned = User::where('name', $input->assigned_email);
            $ticket->save();
    }

    public function update(UpdateTicketRequest $request, $id)
    {
        $input = (object) $request->validated();
        $ticket = User::findorfail($id);

            $ticket->title = $request->input('title');
            $ticket->priority = $request->input('priority');
            $ticket->state = $request->input('state');
            $ticket->content = $request->input('content');
            $ticket->user_id_assigned = User::where('name', $request->input('assigned_email'));
            $ticket->save();
        }
    }

    public function delete($id)
    {
        $ticket = User::findorfail($id);

        $ticket->delete();
    }

}
