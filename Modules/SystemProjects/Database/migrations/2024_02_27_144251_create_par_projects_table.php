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
        Schema::create('par_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_status_id'); // foreign key
            $table->unsignedBigInteger('project_types_id'); // foreign key
            $table->unsignedBigInteger('project_categories_id'); // foreign key
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->string('code', 150)->nullable();
            $table->boolean('is_enabled')->default(false);
            $table->string('project_budget', 150)->nullable();
        

            // for store method
            $table->string('created_by', 50)->nullable();
            $table->string('created_at', 50)->nullable();

            // for update method
            $table->string('updated_by', 50)->nullable();
            $table->string('updated_at', 50)->nullable();

            // for delete method
            $table->string('altered_by', 50)->nullable();
            $table->string('altered_on', 50)->nullable();

            $table->foreign('project_status_id')->references('id')->on('par_project_status')->onDelete('cascade');
            $table->foreign('project_types_id')->references('id')->on('par_project_types')->onDelete('cascade'); 
            $table->foreign('project_categories_id')->references('id')->on('par_project_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('par_projects');
        $table->dropTimestamps();
        $table->timestamps(0); // Disable default created_at and updated_at columns
    }
};
