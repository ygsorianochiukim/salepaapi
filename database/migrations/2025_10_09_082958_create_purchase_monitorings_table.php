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
        Schema::create('purchase_i_information_table', function (Blueprint $table) {
            $table->id('purchase_i_information_id');
            
            $table->foreignId('buyers_i_information_id')
                ->constrained('buyers_i_information_table', 'buyers_i_information_id')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('mp_i_lot_id');
            $table->string('payment_type');
            $table->longText('e_signature');
            $table->boolean('is_active')->default(true);
            $table->timestamp('date_created')->useCurrent();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_monitorings');
    }
};
