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
            $table->enum('ruangan_sidang', ['Ruang Sidang 1 Kartika', 'Ruang Sidang 2 Cakra', 'Ruang Sidang 3 Candra', 'Ruang Sidang Keliling'])->change()->default('Ruang Sidang 1 Kartika');
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
