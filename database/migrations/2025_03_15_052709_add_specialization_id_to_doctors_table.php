<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('specialization_id')->after('doctor')->nullable();
    
            // إضافة مفتاح أجنبي
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['specialization_id']);
            $table->dropColumn('specialization_id');
        });
    }
};