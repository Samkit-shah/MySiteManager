<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePocketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('events', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->String('event_name');
          $table->timestamps();
          });
        Schema::create('earned', function (Blueprint $table) {
            $table->id();
             $table->integer('user_id')->unsigned();
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->integer('earned')->nullable();
            $table->integer('total_earned')->nullable();
            $table->integer('event_id')->unsigned();
              $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->timestamps();
        });
         Schema::create('spent', function (Blueprint $table) {
         $table->id();
         $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->integer('spent')->nullable();
         $table->integer('total_spent')->nullable();
      $table->integer('event_id')->unsigned();
      $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
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
         Schema::dropIfExists('spent');
         Schema::dropIfExists('earned');
         Schema::dropIfExists('events');
    }
}
