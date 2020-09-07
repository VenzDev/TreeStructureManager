<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('text');
            $table->bigInteger('parentID')->unsigned()->nullable();
            
        });

        Schema::table('trees',function(Blueprint $table){
            $table->foreign('parentID')->references('id')->on('trees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trees');
    }
}
