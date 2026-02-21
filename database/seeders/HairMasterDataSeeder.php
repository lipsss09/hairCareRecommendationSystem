<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HairMasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed scalp_conditions
        DB::table('scalp_conditions')->insert([
            ['name' => 'Berminyak', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Iritasi',   'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kering',    'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Normal',    'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed hair_problems
        DB::table('hair_problems')->insert([
            ['name' => 'Ketombe', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rambut Rontok',       'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kulit Kepala Berminyak',   'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kulit Kepala Kering',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kulit Kepala Sensitif',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rambut Kusam',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ramnbut Tipis',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rambut Kering',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rambut Berminyak',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rambut Bercabang',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rambut Mengembang',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gatal pada Kulit Kepala',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kulit Kepala Iritasi',     'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
