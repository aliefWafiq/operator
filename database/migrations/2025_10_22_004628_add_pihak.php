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
            $table->string('namaPihak')->after('id');
            $table->enum('jenisPerkara', ['Gugatan', 'Permohonan'])->default('Gugatan')->after('noPerkara');
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
