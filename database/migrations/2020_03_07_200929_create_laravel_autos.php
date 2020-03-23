<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelAutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand')->nullable(false);
            $table->string('model')->nullable(false);
            $table->string('color')->nullable(false);
            $table->string('plate_number')->unique()->nullable(false);
            $table->boolean('parking_status')->nullable(false);
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autos');
    }
}
