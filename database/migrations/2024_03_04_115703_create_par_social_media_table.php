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
        Schema::create('par_social_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('icons_id'); // foreign key
            $table->string('name', 2000);
            $table->string('link', 100)->nullable();
            $table->string('icon', 255)->nullable();
          
            // for store method
            $table->string('created_by', 50)->nullable();
            $table->string('created_at', 50)->nullable();

            // for update method
            $table->string('updated_by', 50)->nullable();
            $table->string('updated_at', 50)->nullable();

            // for delete method
            $table->string('altered_by', 50)->nullable();
            $table->string('altered_on', 50)->nullable();

            $table->foreign('icons_id')->references('id')->on('par_icons')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('par_social_media');
        $table->dropTimestamps();
        $table->timestamps(0); // Disable default created_at and updated_at columns
    }
};
