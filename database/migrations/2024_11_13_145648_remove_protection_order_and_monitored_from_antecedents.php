<?php

declare(strict_types=1);

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
        Schema::table('beneficiary_antecedents', function (Blueprint $table) {
            $table->dropColumn('has_protection_order');
            $table->dropColumn('electronically_monitored');
            $table->dropColumn('protection_order_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antecedents', function (Blueprint $table) {
            //
        });
    }
};