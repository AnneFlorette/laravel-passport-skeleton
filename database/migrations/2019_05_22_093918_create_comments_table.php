<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Force la bdd sous InnoDB
            $table->bigIncrements('id');
            $table->string('content');
            $table->unsignedBigInteger('user_id'); //Definis la colonne comme non assignée
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //Rend la colonne foreign key sur la table user avec une suppression si le user est supprimé
            $table->unsignedBigInteger('ticket_id'); //Definis la colonne comme non assignée
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade'); //Rend la colonne foreign key sur la table user avec une suppression si le ticket est supprimé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
