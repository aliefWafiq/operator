<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\operators;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika perlu
        operators::truncate(); 

        // Buat data baru dengan hash yang benar
        operators::create([
            'namaOperator' => 'tes',
            'email' => 'tes@gmail.com',
            'password' => '$2y$12$TTkCRi1q.ez5WGPth7gsp.58EmgrVEh7xY6cc.c6JyDqmwnpzqAMK'
        ]);
    }
}