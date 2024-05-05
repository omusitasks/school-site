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
        Schema::create('par_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_types_id'); // foreign key
            $table->unsignedBigInteger('course_categories_id'); // foreign key
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->string('code', 150)->nullable();
            $table->boolean('is_enabled')->default(false);
            $table->binary('image', 10000);

            $table->string('students_enrolled', 150)->nullable();
            $table->string('tutors_registered', 150)->nullable();
            $table->string('subscription_fee', 150)->nullable();
        

            // for store method
            $table->string('created_by', 50)->nullable();
            $table->string('created_at', 50)->nullable();

            // for update method
            $table->string('updated_by', 50)->nullable();
            $table->string('updated_at', 50)->nullable();

            // for delete method
            $table->string('altered_by', 50)->nullable();
            $table->string('altered_on', 50)->nullable();

            $table->foreign('course_types_id')->references('id')->on('par_course_types')->onDelete('cascade'); 
            $table->foreign('course_categories_id')->references('id')->on('par_course_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('par_courses');
        $table->dropTimestamps();
        $table->timestamps(0); // Disable default created_at and updated_at columns
    }
};
