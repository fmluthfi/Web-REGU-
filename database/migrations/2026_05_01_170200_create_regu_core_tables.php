<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_kelas');
            $table->string('tingkat');
            $table->timestamps();
        });

        Schema::create('siswas', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->restrictOnDelete();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('gurus', function (Blueprint $table): void {
            $table->id();
            $table->string('nama');
            $table->string('nip')->nullable()->unique();
            $table->string('mata_pelajaran');
            $table->timestamps();
        });

        Schema::create('guru_kelas', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['guru_id', 'kelas_id']);
        });

        Schema::create('periode_evaluasis', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_periode');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status')->default('tidak_aktif');
            $table->timestamps();
        });

        Schema::create('evaluasis', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->foreignId('periode_evaluasi_id')->constrained('periode_evaluasis')->cascadeOnDelete();
            $table->unsignedTinyInteger('skor_kejelasan');
            $table->unsignedTinyInteger('skor_ketepatan_waktu');
            $table->unsignedTinyInteger('skor_interaksi');
            $table->unsignedTinyInteger('skor_metode');
            $table->text('komentar');
            $table->decimal('skor_akhir', 5, 2);
            $table->string('kategori');
            $table->string('status')->default('menunggu_verifikasi');
            $table->timestamps();
            $table->unique(['siswa_id', 'guru_id', 'periode_evaluasi_id'], 'evaluasis_unique_penilaian');
        });

        Schema::create('verifikasis', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('evaluasi_id')->constrained('evaluasis')->cascadeOnDelete();
            $table->foreignId('guru_bk_id')->constrained('users')->restrictOnDelete();
            $table->text('catatan')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->unique('evaluasi_id');
        });

        Schema::create('audit_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');
            $table->text('description')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('verifikasis');
        Schema::dropIfExists('evaluasis');
        Schema::dropIfExists('periode_evaluasis');
        Schema::dropIfExists('guru_kelas');
        Schema::dropIfExists('gurus');
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('kelas');
    }
};
