<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementCotisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_cotisations', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cotisation');
            $table->text('id_participant');
            $table->text('paiement')->nullable();
            $table->integer('montant_total')->nullable();
            $table->date('dates')->nullable();
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
        Schema::dropIfExists('paiement_cotisations');
    }
}
