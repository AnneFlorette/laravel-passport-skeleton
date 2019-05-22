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
            $table->string('content');
            $table->enum('priority', [1, 2, 3]);
            $table->enum('state', ['PENDING', 'WAITING', 'IN_PROGRESS', 'DONE']);
            $table->timestamp('first_assignation')->nullable();
            $table->timestamp('last_assignation')->nullable();
            $table->integer('user_id');
            $table->integer('user_id_assigned');

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
