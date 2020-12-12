<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addnotetomoneyadded extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('earned', function (Blueprint $table) {
         $table->String('earned_note')->nullable();

        });
         Schema::table('spent', function (Blueprint $table) {

         $table->String('spent_note')->nullable();

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('earned', function ( $table) {
         $table->dropColumn('earned_note');

        });
         Schema::table('spent', function ( $table) {

         $table->dropColumn('spent_note');

         });

    }
}
