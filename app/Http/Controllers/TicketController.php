<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as currentUser;
use App\database\factories\UserFactory;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate as auth;
use App\User;
use App\Ticket;
use App\Comment;

use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Requests\DestroyTicketRequest;
use App\Http\Requests\GetTicketAssignedByUserRequest;
use App\Http\Requests\GetTicketCreatedByUserRequest;

class TicketController extends BaseController
{
    //fonction pour GET 1 ticket en utilisant son id
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return response()->json(
            $ticket
        );
    }

    //fonction pour GET tous les tickets
    public function index()
    {
        return response()->json(
            Ticket::all()
        );
    }

    //fonction POST pour ajouter 1 ticket
    public function create(CreateTicketRequest $request)
    {
        $input = (object) $request->validated();
        $ticket = new Ticket();

        $ticket->title = $input->title;
        $ticket->priority = $input->priority;
        $ticket->state = $input->state;
        $ticket->user_id = currentUser::user()->id;
        if(isset($input->content))
            $ticket->content = $input->content;
        if(isset($input->user_id_assigned)) {
            $ticket->user_id_assigned = $input->user_id_assigned;
            $ticket->first_assignation = now();
            $ticket->last_assignation = now();
        }
        $ticket->save();
        return response(null, '204');

    }

    //fonction PUT pour modifier 1 ou plusieurs données d'un ticket en utilisant son id
    public function update(UpdateTicketRequest $request, $id)
    {
        $input = (object) $request->validated();
        $ticket = Ticket::findOrFail($id);

        $ticket->title = $input->title;
        $ticket->priority = $input->priority;
        $ticket->state = $input->state;
        if(isset($input->content))
            $ticket->content = $input->content;
        if(isset($input->user_id_assigned)) {
            $ticket->user_id_assigned = $input->user_id_assigned;
            if($ticket->first_assignation == null)
                $ticket->first_assignation = now();
            $ticket->last_assignation = now();
        }
        $ticket->save();
        return response(null, '204');
    }

    //fonction DELETE pour supprimer 1 ticket en utilisant son id
    public function delete(DestroyTicketRequest $request, $id)
    {
        $input = (object) $request->validated();
        $ticket = Ticket::findOrFail($id);

        $ticket->delete();
        return response(null, '204');
    }

    //fonction pour GET tous les tickets créer par un même utilisateur en utilisant son id
    public function listTicketCreatedByActualUser(GetTicketCreatedByUserRequest $request, $id){
        
        $input = (object) $request->validated();

        $tickets = Ticket::where('user_id', $id);

        return $tickets;
    }

    //fonction pour GET tous les commentaires assigné à un même utilisateur en utilisant son id
    public function listTicketAssignedByActualUser(GetTicketAssignedByUserRequest $request, $id){

        $input = (object) $request->validated();

        $tickets = Ticket::where('user_id_assigned', $id);

        return $tickets;
    }
}
