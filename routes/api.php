<?php

use Illuminate\Http\Request;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

//use Symfony\Component\Routing\Annotation\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| SessionController routes
|--------------------------------------------------------------------------
|
| Those routes must be used by local API clients, see SessionController.
|
*/
Route::post('/token', 'SessionController@createToken')
    ->name('api.session.token.create');

Route::post('/token/refresh', 'SessionController@refreshToken')
    ->name('api.session.token.refresh');

Route::middleware('auth:api')
    ->delete('/token', 'SessionController@destroyToken')
    ->name('api.session.token.destroy');

Route::middleware('auth:api')
    ->get('/user', 'SessionController@getUser')
    ->name('api.session.user');


    //--------------------------------
    // Routes User
    //--------------------------------

    // Get all users
Route::get('/users','UserController@index')
    ->name('api.users.all');

    //Get one user by ID
Route::get('/users/{id}','UserController@show')
    ->name('api.user.id');

    //Add a user
Route::post('/users','UserController@create')
    ->name('api.user.add');


    //Put a user
Route::middleware('auth:api')
    ->put('/users/{id}', 'UserController@update')
    ->name('api.user.put');

    //Patch a user
// Route::patch('/user','UserController@')
//     ->name('api.user.patch');

    //Delete a user
Route::middleware('auth:api')
    ->delete('/users/{id}','UserController@delete')
    ->name('api.user.del');




//--------------------------------------
// Routes Tickets
//--------------------------------------

    // Get all tickets
Route::get('/tickets','TicketController@index')
    ->name('api.ticket.all');

    //Get one ticket by ID
Route::get('/tickets/{id}','TicketController@show')
    ->name('api.ticket.id');

    //Add a ticket
Route::middleware('auth:api')
    ->post('/tickets','TicketController@create')
    ->name('api.ticket.add');


    //Put a ticket
Route::middleware('auth:api')
    ->put('/tickets/{id}', 'TicketController@update')
    ->name('api.ticket.put');

    //Patch a ticket
// Route::patch('/ticket','TicketController@')
//     ->name('api.ticket.patch');

    //Delete a ticket
Route::middleware('auth:api')
    ->delete('/tickets/{id}','TicketController@delete')
    ->name('api.ticket.del');

    //Get ticket for actual user
Route::middleware('auth:api')
    ->get('/tickets/created','TicketController@listTicketCreatedByActualUser')
    ->name('api.ticket.getbycreated');

    //Get users for actual ticket
Route::middleware('auth:api')
    ->get('/tickets/assigned/','TicketController@listTicketAssignedByActualUser')
    ->name('api.ticket.getbyassigned');

//--------------------------------------
// Routes Commentaires
//--------------------------------------

    // Get all Comment
    Route::get('/comments','CommentController@index')
    ->name('api.comment.all');

    //Get one comment by ID
Route::get('/comments/{id}','CommentController@show')
    ->name('api.comment.id');

    //Add a comment
Route::middleware('auth:api')
    ->post('/comments','CommentController@create')
    ->name('api.comment.add');


    //Put a comment
Route::middleware('auth:api')
    ->put('/comments/{id}', 'CommentController@update')
    ->name('api.comment.put');

    //Patch a comment
// Route::patch('/comment','CommentController@')
//     ->name('api.comment.patch');

    //Delete a comment
Route::middleware('auth:api')
    ->delete('/comments/{id}','CommentController@delete')
    ->name('api.comment.del');
