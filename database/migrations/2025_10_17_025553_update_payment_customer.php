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
        Schema::table('purchase_i_information_table', function (Blueprint $table) {
            $table -> string('beneficiary1');
            $table -> string('beneficiary2');
            $table -> integer('datePayment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_i_information_table', function (Blueprint $table) {
            //
        });
    }
};
