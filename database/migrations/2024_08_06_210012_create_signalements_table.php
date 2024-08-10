<?php

use App\Models\TypeSignalement;
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
        Schema::create('signalements', function (Blueprint $table) {
            $table->id();
            $table->string("raison");
            $table->longText("description");
            $table->enum("statut", ["estTraite", "nonTraite", "enCours"])->default("nonTraite");
            $table->unsignedInteger(TypeSignalement::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signalements');
    }
};
