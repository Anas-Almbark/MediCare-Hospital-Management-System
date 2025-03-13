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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patient")->constrained("users")->cascadeOnDelete();
            $table->foreignId("doctor")->constrained("users")->cascadeOnDelete();
            $table->date("date");
            $table->text("notes")->nullable();
            $table->enum("status", ["pending", "confirmed", "cancelled"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
