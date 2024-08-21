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
        Schema::create('student_discipline', function (Blueprint $table) {
            $table->uuid('student_id');
            $table->uuid('discipline_id');
            $table->timestamps();

            $table->primary(['student_id', 'discipline_id']);

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_discipline');
    }
};
