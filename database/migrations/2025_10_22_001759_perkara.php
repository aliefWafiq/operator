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
            $table->date('tanggal_sidang');
            $table->string('noPerkara');
            $table->enum('sidang_Keliling', ['YA', 'TIDAK'])->default('TIDAK');
            $table->string('ruangan_sidang');
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
