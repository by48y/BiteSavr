<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mitra_profiles', function (Blueprint $table) {
            $table->string('no_telepon', 20)->nullable()->after('alamat');
            $table->string('email_usaha', 150)->nullable()->after('no_telepon');
            $table->text('deskripsi')->nullable()->after('email_usaha');
            $table->string('foto_usaha')->nullable()->after('deskripsi');
            $table->string('kategori', 100)->nullable()->after('foto_usaha');
            $table->string('jam_operasional', 100)->nullable()->after('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('mitra_profiles', function (Blueprint $table) {
            $table->dropColumn(['no_telepon', 'email_usaha', 'deskripsi', 'foto_usaha', 'kategori', 'jam_operasional']);
        });
    }
};
