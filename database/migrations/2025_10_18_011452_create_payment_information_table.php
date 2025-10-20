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
        Schema::create('payment_i_information_table', function (Blueprint $table) {
            $table->id('payment_i_information_id');
            $table->foreignId('buyers_i_information_id')
                ->constrained('buyers_i_information_table', 'buyers_i_information_id')
                ->cascadeOnDelete();
            $table -> longText('sales_temp_pa');
            $table -> integer('amount');
            $table -> integer('otp');
            $table->unsignedBigInteger(column: 'created_by');
            $table->timestamp('data_created');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_information');
    }
};
