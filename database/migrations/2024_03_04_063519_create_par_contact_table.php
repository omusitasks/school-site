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
        Schema::create('par_contact', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('subject', 150)->nullable();
            $table->string('message', 150)->nullable();
          
            // for store method
            $table->string('created_by', 50)->nullable();
            $table->string('created_at', 50)->nullable();

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
        Schema::dropIfExists('par_contact');
        $table->dropTimestamps();
        $table->timestamps(0); // Disable default created_at and updated_at columns
    }
};
