<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('takes', function (Blueprint $table) {
            $table->id(); // 👈 AUTO_INCREMENT PRIMARY KEY (BIGINT)
            $table->foreignId('student_id')
                  ->constrained('students', 'student_id') 
                  ->onDelete('cascade');
            $table->foreignId('course_id')
                  ->constrained('courses', 'course_id') 
                  ->onDelete('cascade');
            $table->dateTime('enroll_date')->useCurrent(); 
            $table->unique(['student_id', 'course_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('takes');
    }
};
