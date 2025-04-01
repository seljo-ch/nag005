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
        Schema::table('call_journals', function (Blueprint $table) {
            $table->string('forwarded_to')->nullable();
            $table->enum('forwarded_via', ['phone', 'email', 'other'])->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('call_journals', function (Blueprint $table) {
            $table->dropColumn(['forwarded_to', 'forwarded_via']);
        });
    }
};
