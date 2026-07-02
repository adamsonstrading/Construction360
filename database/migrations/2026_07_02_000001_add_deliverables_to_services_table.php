<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds the deliverables column to the services table.
     * This column stores comma-separated scope deliverables for sub-services.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->text('deliverables')->nullable()->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('deliverables');
        });
    }
};
