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
        Schema::create('par_contact_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_icon_id'); // foreign key
            $table->string('street_address_name', 2000);

            $table->string('city', 100)->nullable();
            $table->string('country', 255)->nullable();

            $table->unsignedBigInteger('phone_icon_id'); // foreign key
            $table->string('company_phone_number', 100)->nullable();

            $table->unsignedBigInteger('email_icon_id'); // foreign key
            $table->string('company_email', 255)->nullable();

          
            // for store method
            $table->string('created_by', 50)->nullable();
            $table->string('created_at', 50)->nullable();

            // for update method
            $table->string('updated_by', 50)->nullable();
            $table->string('updated_at', 50)->nullable();

            // for delete method
            $table->string('altered_by', 50)->nullable();
            $table->string('altered_on', 50)->nullable();

            $table->foreign('address_icon_id')->references('id')->on('par_icons')->onDelete('cascade'); 
            $table->foreign('email_icon_id')->references('id')->on('par_icons')->onDelete('cascade'); 
            $table->foreign('phone_icon_id')->references('id')->on('par_icons')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('par_contact_info');
        $table->dropTimestamps();
        $table->timestamps(0); // Disable default created_at and updated_at columns
    }
};
