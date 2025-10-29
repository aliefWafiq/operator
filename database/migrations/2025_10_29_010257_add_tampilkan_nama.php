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
        Schema::table('perkara', function (Blueprint $table) {
            $table->enum('tampilkan_nama', ['Tampilkan', 'Tidak tampilkan'])->default('Tampilkan')->after('namaPihak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
