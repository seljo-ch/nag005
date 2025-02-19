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
        Schema::create('tel_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('call_id')->nullable();
            $table->string('senderEmail')->nullable(); // Absender
            $table->string('recipientEmail')->nullable(); // Empfänger
            $table->string('callerNumber')->nullable(); // Telefonnummer
            $table->string('callerName')->nullable(); // Anrufername
            $table->dateTime('callerDate')->nullable(); // Datum & Uhrzeit
            $table->string('subject')->nullable(); // Betreff
            $table->text('message')->nullable(); // Nachricht
            $table->timestamps();

            // Fremdschlüssel-Beziehung zu CallLog (optional)
            $table->foreign('call_id')->references('id')->on('call_logs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tel_notes');
    }
};
