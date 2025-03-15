<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            // Add foreign key constraint only
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['specialization_id']);
        });
    }
};