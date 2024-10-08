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
            $table->unsignedBigInteger("typesignalement_id");
            $table->foreign("typesignalement_id")->references("id")->on("type_signalements")->onDelete("cascade");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on(   "users")->onDelete("cascade");
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
