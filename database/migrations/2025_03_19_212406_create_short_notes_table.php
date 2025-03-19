<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('short_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('call_journal_id')->constrained()->onDelete('cascade'); // Verknüpfung zu CallJournal
            $table->text('note'); // Notizfeld
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('short_notes');
    }
};

