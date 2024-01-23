<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('locations_id');
            $table->string('type');
            $table->string('pieces');
            $table->string('cuisine');
            $table->string('douches');
            $table->string('wc');
            $table->text('court_description');
            $table->string('pays');
            $table->string('ville');
            $table->string('zone');
            $table->string('loyer');
            $table->string('avances');
            $table->string('prepayes');
            $table->string('cautions');
            $table->string('commission');
            $table->longText('longue_description');
            $table->string('auteur_name');
            $table->string('auteur_type');
            $table->string('auteur_id');
            $table->string('statut')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
