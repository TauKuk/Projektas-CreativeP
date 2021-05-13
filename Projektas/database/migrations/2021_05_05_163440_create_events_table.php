<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');

            $table->string('title');
            $table->string('place')->nullable();

            $table->text('description')->nullable();
            $table->binary('picture')->nullable();
            $table->dateTime('start_date', $precision = 0);
            $table->dateTime('end_date', $precision = 0);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
