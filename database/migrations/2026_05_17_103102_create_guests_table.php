<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');           // Имя
            $table->string('last_name');             // Фамилия
            $table->string('partner_first_name')->nullable(); // Имя партнёра
            $table->string('partner_last_name')->nullable();  // Фамилия партнёра
            $table->enum('status', ['will_come', 'will_not_come'])->default('will_come');
            $table->boolean('with_partner')->default(false);   // С парой или нет
            $table->text('message')->nullable();     // Сообщение от гостя
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
