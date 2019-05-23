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
use App\Http\Requests\DestroyTicketRequest;

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
            $ticket->user_id = $input->user_id;
            if($input->content)
                $ticket->content = $input->content;
            if($input->user_id_assigned) {
                $ticket->user_id_assigned = $input->user_id_assigned;
                $ticket->first_assignation = now();
                $ticket->last_assignation = now();
            }
            $ticket->save();

    }

    public function update(UpdateTicketRequest $request, $id)
    {
        $input = (object) $request->validated();
        $ticket = Ticket::findorfail($id);

            $ticket->title = $input->title;
            $ticket->priority = $input->priority;
            $ticket->state = $input->state;
            if($input->content)
                $ticket->content = $input->content;
            if($input->user_id_assigned) {
                $ticket->user_id_assigned = $input->user_id_assigned;
                $ticket->last_assignation = now();
            }
            $ticket->save();
    }

    public function delete(DestroyTicketRequest $request, $id)
    {
        $input = (object) $request->validated();
        $ticket = Ticket::findorfail($id);

        $ticket->delete();
    }

}
