<?php

use App\Models\TypeSignalement;
use App\Models\User;
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
            $table->string("sujet");
            $table->date("date");
            $table->longText("description");
            $table->enum("statut", ["estTraite", "nonTraite", "enCours"])->default("nonTraite");
            $table->unsignedInteger(TypeSignalement::class);
            $table->unsignedInteger(User::class);
            // $table->foreignId('user_id')->constrained('users');
            // $table->foreignId('typesignalement_id')->constrained('type_signalements'); 
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
