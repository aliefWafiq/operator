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
        Schema::create('perkara', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('namaPihak');
            $table->date('tanggal_sidang');
            $table->string('noPerkara');
            $table->enum('jenisPerkara', ['Gugatan', 'Permohonan'])->default('Gugatan');
            $table->enum('sidang_Keliling', ['YA', 'TIDAK'])->default('TIDAK');
            $table->string('ruangan_sidang');
            // $table->enum('ruangan_sidang', ['Ruang Sidang 1 Kartika', 'Ruang Sidang 2 Cakra', 'Ruang Sidang 3 Candra', 'Ruang Sidang Keliling'])->default('Ruang Sidang 1 Kartika');
            $table->string('agenda');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkara');
    }
};
