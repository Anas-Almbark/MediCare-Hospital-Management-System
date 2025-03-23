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
            $table->foreignId("patient_id")->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignId("doctor_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("schedule_id")->constrained("doctor_schedules")->cascadeOnDelete();
            $table->enum('day_of_week', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
            $table->date('date');
            $table->time('start_time'); // بداية الدوام
            $table->time('end_time'); // نهاية الدوام
            $table->text("notes")->nullable();
            $table->enum("status", ["available", "pending", "confirmed", "cancelled", "rejected"]);
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
