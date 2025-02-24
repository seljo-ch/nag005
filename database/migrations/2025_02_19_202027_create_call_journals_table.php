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
        Schema::create('call_journals', function (Blueprint $table) {
            $table->id();
            $table->string('callerNumber')->nullable();
            $table->string('callerDisplayName')->nullable();
            $table->string('adUser')->nullable();
            $table->string('adUserEmail')->nullable();
            $table->boolean('note')->nullable();
            $table->dateTime('timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_journals');
    }
};
