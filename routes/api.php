<?php

use Illuminate\Http\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
Route::get('/user/{id}','UserController@show')
    ->name('api.user.id');

    //Add a user
Route::post('/user','UserController@create')
    ->name('api.user.add');


    //Put a user
Route::put('/user', 'UserController@update')
    ->name('api.user.put');

    //Patch a user
// Route::patch('/user','UserController@')
//     ->name('api.user.patch');

    //Delete a user
Route::delete('/user','UserController@delete')
    ->name('api.user.del');   




//--------------------------------------
// Routes Tickets
//--------------------------------------

    // Get all tickets
    Route::get('/tickets','TicketController@index')
    ->name('api.ticket.all');

    //Get one ticket by ID
Route::get('/ticket/{id}','TicketController@show')
    ->name('api.ticket.id');

    //Add a ticket
Route::post('/ticket','TicketController@create')
    ->name('api.ticket.add');


    //Put a ticket
Route::put('/ticket', 'TicketController@update')
    ->name('api.ticket.put');

    //Patch a ticket
// Route::patch('/ticket','TicketController@')
//     ->name('api.ticket.patch');

    //Delete a ticket
Route::delete('/ticket','TicketController@delete')
    ->name('api.ticket.del');


//--------------------------------------
// Routes Commentaires
//--------------------------------------

    // Get all Comment
    Route::get('/comments','CommentController@index')
    ->name('api.comment.all');

    //Get one comment by ID
Route::get('/comment/{id}','CommentController@show')
    ->name('api.comment.id');

    //Add a comment
Route::post('/comment','CommentController@create')
    ->name('api.comment.add');


    //Put a comment
Route::put('/comment', 'CommentController@update')
    ->name('api.comment.put');

    //Patch a comment
// Route::patch('/comment','CommentController@')
//     ->name('api.comment.patch');

    //Delete a comment
Route::delete('/comment','CommentController@delete')
    ->name('api.comment.del');