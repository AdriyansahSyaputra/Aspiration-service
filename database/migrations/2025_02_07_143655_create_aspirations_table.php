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
        Schema::create('aspirations', function (Blueprint $table) {
            $table->string('id', 50)->primary()->nullable(false);
            $table->string('title', 255)->nullable(false);
            $table->string('slug')->unique()->nullable(false);
            $table->string('institution', 255)->nullable(false);
            $table->text('aspiration')->nullable(false);
            $table->date('date_occurred')->nullable(false);
            $table->string('location', 255)->nullable(false);
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->string('attachment')->nullable(true);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
