<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('email')->nullable()->change();
            $table->string('nis')->nullable()->unique()->after('email');
            $table->string('role')->default('siswa')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropUnique(['nis']);
            $table->dropColumn(['nis', 'role']);
            $table->string('email')->nullable(false)->change();
        });
    }
};
