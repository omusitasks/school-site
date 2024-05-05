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
        Schema::create('par_student_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('student_name', 2000);
            $table->binary('student_image', 10000)->nullable();
            $table->string('student_course', 255)->nullable();
            $table->string('testmonial_message', 100)->nullable();
          
            // for store method
            $table->string('created_by', 50)->nullable();
            $table->string('created_at', 50)->nullable();

            // for update method
            $table->string('updated_by', 50)->nullable();
            $table->string('updated_at', 50)->nullable();

            // for delete method
            $table->string('altered_by', 50)->nullable();
            $table->string('altered_on', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('par_student_testimonials');
        $table->dropTimestamps();
        $table->timestamps(0); // Disable default created_at and updated_at columns
    }
};


