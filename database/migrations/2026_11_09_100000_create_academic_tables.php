<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departemens', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama')->index();
            $table->timestamps();
        });

        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama')->index();
            $table->string('email')->unique();
            $table->foreignId('departemen_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });

        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nrp')->unique();
            $table->string('nama')->index();
            $table->string('email')->unique();
            $table->foreignId('departemen_id')->constrained()->restrictOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->index();
            $table->text('deskripsi')->nullable();
            $table->foreignId('departemen_id')->constrained()->restrictOnDelete();
            $table->foreignId('dosen_id')->constrained('dosens')->restrictOnDelete();
            $table->date('deadline');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
        Schema::dropIfExists('mahasiswas');
        Schema::dropIfExists('dosens');
        Schema::dropIfExists('departemens');
    }
};
