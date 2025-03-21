<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee')->constrained("users")->cascadeOnDelete();
            $table->decimal('base_salary', 10, 2);
            $table->decimal('bonus', 10, 2)->nullable();
            $table->decimal('deductions', 10, 2)->nullable();
            $table->date('payment_date');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
