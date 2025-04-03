<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->foreignId('patient_id')
                  ->after('id')
                  ->constrained('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropColumn('patient_id');
        });
    }
};