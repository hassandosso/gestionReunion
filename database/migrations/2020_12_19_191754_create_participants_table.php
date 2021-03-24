<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('surnom')->nullable();
            $table->date('naissance')->nullable();
            $table->string('adresse')->nullable();
            $table->string('identification');
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('situationmatri');
            $table->string('pere')->nullable();
            $table->string('photo')->nullable();
            $table->integer('decede')->nullable();
            $table->date('date_deces')->nullable();
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
        Schema::dropIfExists('participants');
    }
}
