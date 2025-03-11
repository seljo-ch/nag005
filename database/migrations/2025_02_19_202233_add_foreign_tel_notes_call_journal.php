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
        Schema::table('tel_notes', function (Blueprint $table) {
            $table->foreign('call_id')
                ->references('id')
                ->on('call_journals')
                ->nullOnDelete();
        }); //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tel_notes', function (Blueprint $table) {
            $table->dropForeign(['call_id']); // Sicherstellen, dass der Foreign Key entfernt wird
        });
    }
};
