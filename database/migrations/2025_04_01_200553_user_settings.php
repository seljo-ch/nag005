<?php

// Migration: create_user_settings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('show_forwarding')->default(true);
            $table->boolean('edit_forwarding')->default(true);
            $table->boolean('disable_forwarding')->default(false);
            $table->boolean('show_shortnotes')->default(true);
            $table->boolean('edit_own_shortnotes_only')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
