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
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('content')->nullable();
            $table->enum('priority', [1, 2, 3]);
            $table->enum('state', ['PENDING', 'WAITING', 'IN_PROGRESS', 'DONE']);
            $table->timestamp('first_assignation')->nullable();
            $table->timestamp('last_assignation')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_assigned')->nullable();
            $table->foreign('user_id_assigned')->references('id')->on('users')->onDelete('cascade');

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
