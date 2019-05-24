<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Force la bdd sous InnoDB
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('content')->nullable();
            $table->enum('priority', [1, 2, 3]); //Limite les choix
            $table->enum('state', ['PENDING', 'WAITING', 'IN_PROGRESS', 'DONE']); //Limite les choix
            $table->timestamp('first_assignation')->nullable();
            $table->timestamp('last_assignation')->nullable();
            $table->unsignedBigInteger('user_id'); //Definis la colonne comme non assignée
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //Rend la colonne foreign key sur la table user avec une suppression si le user est supprimé
            $table->unsignedBigInteger('user_id_assigned')->nullable(); //Definis la colonne comme non assignée
            $table->foreign('user_id_assigned')->references('id')->on('users')->onDelete('set null'); //Rend la colonne foreign key sur la table user avec une suppression si le user est supprimé

            $table->timestamps(); //created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
