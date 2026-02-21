<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Shampoo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Conditioner', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hair Mask', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Scalp Serum', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hair Tonic', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hair Oil', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hair Vitamin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Heat Protection', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Creambath', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hair Mist', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hair Serum', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
