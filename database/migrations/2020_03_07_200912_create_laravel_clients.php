<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('patronymic')->nullable(false);
            $table->enum('gender', ['female', 'male'])->nullable(false);
            $table->string('phone')->unique()->nullable(false);
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
