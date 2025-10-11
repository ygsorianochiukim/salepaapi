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
        Schema::create('buyers_i_information_table', function (Blueprint $table) {
            $table->id('buyers_i_information_id');
            $table->string('buyers_name');
            $table->bigInteger('contact_number');
            $table->string('province')->nullable();
            $table->string('municipality')->nullable();
            $table->string('barangay')->nullable();
            $table->string('purok')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('sex')->nullable();
            $table->integer('zipcode')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('otp')->nullable();
            $table->unsignedBigInteger(column: 'created_by');
            $table->timestamp('data_created');
            $table->boolean('is_active')->default(true);
            $table->integer('temp_ref_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyers_information');
    }
};
