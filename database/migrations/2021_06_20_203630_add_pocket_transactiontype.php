<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPocketTransactiontype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('earned', function (Blueprint $table) {
         $table->String('earned_mode')->default('cash');

        });
         Schema::table('spent', function (Blueprint $table) {

         $table->String('spent_mode')->default('cash');

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
         $table->dropColumn('earned_mode');

        });
         Schema::table('spent', function ( $table) {

         $table->dropColumn('spent_mode');

         });
    }
}
