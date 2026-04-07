<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientAndMappingSeeder extends Seeder
{
    public function run(): void
    {
        // ---------------------------------------------------------------
        // 1. MASTER INGREDIENTS (I01–I69)
        // ---------------------------------------------------------------
        $ingredients = [
            ['ingredient_id' => 'I01', 'name' => 'adenosine'],
            ['ingredient_id' => 'I02', 'name' => 'aesculus hippocastanum seed extract'],
            ['ingredient_id' => 'I03', 'name' => 'allantoin'],
            ['ingredient_id' => 'I04', 'name' => 'argania spinosa kernel oil'],
            ['ingredient_id' => 'I05', 'name' => 'arginine'],
            ['ingredient_id' => 'I06', 'name' => 'ascorbic acid'],
            ['ingredient_id' => 'I07', 'name' => 'azelaic acid'],
            ['ingredient_id' => 'I08', 'name' => 'biotin'],
            ['ingredient_id' => 'I09', 'name' => 'caffeine'],
            ['ingredient_id' => 'I10', 'name' => 'camellia sinensis leaf extract'],
            ['ingredient_id' => 'I11', 'name' => 'centella asiatica extract'],
            ['ingredient_id' => 'I12', 'name' => 'ceramide np'],
            ['ingredient_id' => 'I13', 'name' => 'chrysin'],
            ['ingredient_id' => 'I14', 'name' => 'climbazole'],
            ['ingredient_id' => 'I15', 'name' => 'copper tripeptide-1'],
            ['ingredient_id' => 'I16', 'name' => 'diaminopyrimidine oxide'],
            ['ingredient_id' => 'I17', 'name' => 'glycyrrhiza glabra root extract'],
            ['ingredient_id' => 'I18', 'name' => 'hydrolyzed keratin'],
            ['ingredient_id' => 'I19', 'name' => 'hydrolyzed silk'],
            ['ingredient_id' => 'I20', 'name' => 'hydrolyzed wheat protein'],
            ['ingredient_id' => 'I21', 'name' => 'keratin'],
            ['ingredient_id' => 'I22', 'name' => 'lactic acid'],
            ['ingredient_id' => 'I23', 'name' => 'menthol'],
            ['ingredient_id' => 'I24', 'name' => 'niacinamide'],
            ['ingredient_id' => 'I25', 'name' => 'oleanolic acid'],
            ['ingredient_id' => 'I26', 'name' => 'panax ginseng root extract'],
            ['ingredient_id' => 'I27', 'name' => 'panthenol'],
            ['ingredient_id' => 'I28', 'name' => 'piroctone olamine'],
            ['ingredient_id' => 'I29', 'name' => 'polygonum multiflorum root extract'],
            ['ingredient_id' => 'I30', 'name' => 'retinyl palmitate'],
            ['ingredient_id' => 'I31', 'name' => 'rosmarinus officinalis leaf extract'],
            ['ingredient_id' => 'I32', 'name' => 'rosmarinus officinalis leaf oil'],
            ['ingredient_id' => 'I33', 'name' => 'salicylic acid'],
            ['ingredient_id' => 'I34', 'name' => 'sodium ascorbyl phosphate'],
            ['ingredient_id' => 'I35', 'name' => 'tocopherol'],
            ['ingredient_id' => 'I36', 'name' => 'tocopheryl acetate'],
            ['ingredient_id' => 'I37', 'name' => 'zinc gluconate'],
            ['ingredient_id' => 'I38', 'name' => 'zinc lactate'],
            ['ingredient_id' => 'I39', 'name' => 'zinc pca'],
            ['ingredient_id' => 'I40', 'name' => 'zinc pyrithione'],
            ['ingredient_id' => 'I41', 'name' => 'ketoconazole'],
            ['ingredient_id' => 'I42', 'name' => 'selenium sulfide'],
            ['ingredient_id' => 'I43', 'name' => 'tea tree oil'],
            ['ingredient_id' => 'I44', 'name' => 'minoxidil'],
            ['ingredient_id' => 'I45', 'name' => 'aminexil'],
            ['ingredient_id' => 'I46', 'name' => 'procapil'],
            ['ingredient_id' => 'I47', 'name' => 'redensyl'],
            ['ingredient_id' => 'I48', 'name' => 'capixyl'],
            ['ingredient_id' => 'I49', 'name' => 'baicapil'],
            ['ingredient_id' => 'I50', 'name' => 'biotinoyl tripeptide-1'],
            ['ingredient_id' => 'I51', 'name' => 'acetyl tetrapeptide-3'],
            ['ingredient_id' => 'I52', 'name' => 'palmitoyl tetrapeptide-7'],
            ['ingredient_id' => 'I53', 'name' => 'hydrolyzed collagen'],
            ['ingredient_id' => 'I54', 'name' => 'silk amino acids'],
            ['ingredient_id' => 'I55', 'name' => 'sodium hyaluronate'],
            ['ingredient_id' => 'I56', 'name' => 'glycerin'],
            ['ingredient_id' => 'I57', 'name' => 'butyrospermum parkii'],
            ['ingredient_id' => 'I58', 'name' => 'simmondsia chinensis seed oil'],
            ['ingredient_id' => 'I59', 'name' => 'olea europaea oil'],
            ['ingredient_id' => 'I60', 'name' => 'macadamia ternifolia seed oil'],
            ['ingredient_id' => 'I61', 'name' => 'ricinus communis seed oil'],
            ['ingredient_id' => 'I62', 'name' => 'aloe barbadensis leaf extract'],
            ['ingredient_id' => 'I63', 'name' => 'bisabolol'],
            ['ingredient_id' => 'I64', 'name' => 'chamomilla recutita extract'],
            ['ingredient_id' => 'I65', 'name' => 'calendula officinalis extract'],
            ['ingredient_id' => 'I66', 'name' => 'hamamelis virginiana extract'],
            ['ingredient_id' => 'I67', 'name' => 'beta-glucan'],
            ['ingredient_id' => 'I68', 'name' => 'dimethicone'],
            ['ingredient_id' => 'I69', 'name' => 'amodimethicone'],
        ];

        DB::table('ingredients')->insertOrIgnore($ingredients);

        // ---------------------------------------------------------------
        // 2. PROBLEM -> INGREDIENT MAPPING (dari Mapping.xlsx terbaru)
        // hair_problem_id: 1=Ketombe, 2=Rambut Rontok, 3=Kulit Kepala Berminyak,
        // 4=Kulit Kepala Kering, 5=Kulit Kepala Sensitif, 6=Rambut Kusam,
        // 7=Rambut Tipis, 8=Rambut Kering, 9=Rambut Berminyak,
        // 10=Rambut Bercabang, 11=Rambut Mengembang,
        // 12=Gatal pada Kulit Kepala, 13=Kulit Kepala Iritasi
        // ---------------------------------------------------------------

        $ingMap = DB::table('ingredients')->pluck('id', 'ingredient_id');

        $rawMapping = [

            // M01 - Ketombe (19 bahan)
            1 => [
                'I02' => 2, 'I07' => 1, 'I10' => 1, 'I14' => 3,
                'I17' => 2, 'I22' => 2, 'I24' => 2, 'I28' => 3,
                'I30' => 2, 'I32' => 2, 'I33' => 2, 'I37' => 2,
                'I38' => 2, 'I39' => 2, 'I40' => 3, 'I41' => 3,
                'I42' => 3, 'I43' => 2, 'I66' => 2,
            ],

            // M02 - Rambut Rontok (30 bahan)
            2 => [
                'I01' => 3, 'I02' => 3, 'I05' => 2, 'I06' => 2,
                'I07' => 2, 'I08' => 2, 'I09' => 2, 'I10' => 2,
                'I13' => 1, 'I15' => 3, 'I16' => 3, 'I17' => 2,
                'I25' => 3, 'I26' => 2, 'I29' => 2, 'I31' => 2,
                'I32' => 2, 'I34' => 1, 'I35' => 2, 'I36' => 2,
                'I44' => 3, 'I45' => 3, 'I46' => 3, 'I47' => 3,
                'I48' => 3, 'I49' => 2, 'I50' => 3, 'I51' => 3,
                'I52' => 2, 'I61' => 2,
            ],

            // M03 - Kulit Kepala Berminyak (20 bahan)
            3 => [
                'I07' => 2, 'I10' => 2, 'I14' => 2, 'I17' => 2,
                'I22' => 2, 'I24' => 3, 'I28' => 2, 'I30' => 2,
                'I31' => 1, 'I32' => 2, 'I33' => 3, 'I37' => 3,
                'I38' => 3, 'I39' => 3, 'I40' => 2, 'I41' => 2,
                'I42' => 2, 'I43' => 2, 'I58' => 2, 'I66' => 3,
            ],

            // M04 - Kulit Kepala Kering (21 bahan)
            4 => [
                'I02' => 2, 'I03' => 2, 'I04' => 2, 'I11' => 2,
                'I12' => 2, 'I17' => 2, 'I27' => 2, 'I36' => 2,
                'I53' => 2, 'I55' => 3, 'I56' => 3, 'I57' => 2,
                'I58' => 2, 'I59' => 2, 'I60' => 2, 'I61' => 2,
                'I62' => 3, 'I63' => 2, 'I64' => 2, 'I65' => 2,
                'I67' => 2,
            ],

            // M05 - Kulit Kepala Sensitif (41 bahan)
            5 => [
                'I02' => 2, 'I04' => 1, 'I06' => 1, 'I07' => 2,
                'I10' => 2, 'I11' => 3, 'I12' => 1, 'I14' => 1,
                'I17' => 3, 'I23' => 2, 'I24' => 2, 'I27' => 1,
                'I28' => 1, 'I30' => 1, 'I31' => 1, 'I32' => 1,
                'I34' => 1, 'I35' => 1, 'I36' => 2, 'I37' => 2,
                'I38' => 2, 'I39' => 1, 'I40' => 1, 'I41' => 1,
                'I42' => 1, 'I43' => 2, 'I52' => 2, 'I53' => 1,
                'I55' => 1, 'I56' => 1, 'I57' => 1, 'I58' => 1,
                'I59' => 1, 'I60' => 1, 'I61' => 1, 'I62' => 2,
                'I63' => 3, 'I64' => 3, 'I65' => 3, 'I66' => 2,
                'I67' => 3,
            ],

            // M06 - Rambut Kusam (32 bahan)
            6 => [
                'I02' => 2, 'I04' => 3, 'I05' => 1, 'I06' => 2,
                'I12' => 2, 'I13' => 1, 'I15' => 1, 'I18' => 2,
                'I19' => 3, 'I20' => 2, 'I21' => 2, 'I27' => 2,
                'I33' => 2, 'I34' => 2, 'I35' => 2, 'I36' => 3,
                'I53' => 2, 'I54' => 3, 'I55' => 2, 'I56' => 2,
                'I57' => 2, 'I58' => 2, 'I59' => 2, 'I60' => 2,
                'I61' => 2, 'I62' => 2, 'I63' => 1, 'I64' => 1,
                'I65' => 1, 'I67' => 1, 'I68' => 3, 'I69' => 3,
            ],

            // M07 - Rambut Tipis (25 bahan)
            7 => [
                'I01' => 3, 'I02' => 3, 'I05' => 2, 'I07' => 2,
                'I08' => 2, 'I09' => 2, 'I10' => 2, 'I13' => 1,
                'I15' => 3, 'I16' => 2, 'I25' => 2, 'I26' => 2,
                'I29' => 2, 'I31' => 2, 'I32' => 2, 'I44' => 3,
                'I45' => 2, 'I46' => 2, 'I47' => 3, 'I48' => 2,
                'I49' => 2, 'I50' => 3, 'I51' => 2, 'I52' => 2,
                'I61' => 2,
            ],

            // M08 - Rambut Kering (31 bahan)
            8 => [
                'I02' => 2, 'I03' => 2, 'I04' => 3, 'I05' => 1,
                'I11' => 2, 'I12' => 3, 'I15' => 1, 'I17' => 2,
                'I18' => 2, 'I19' => 2, 'I20' => 2, 'I21' => 2,
                'I27' => 3, 'I35' => 1, 'I36' => 2, 'I53' => 3,
                'I54' => 2, 'I55' => 3, 'I56' => 3, 'I57' => 3,
                'I58' => 2, 'I59' => 3, 'I60' => 3, 'I61' => 2,
                'I62' => 3, 'I63' => 2, 'I64' => 2, 'I65' => 2,
                'I67' => 2, 'I68' => 2, 'I69' => 2,
            ],

            // M09 - Rambut Berminyak (19 bahan)
            9 => [
                'I07' => 2, 'I10' => 2, 'I14' => 2, 'I22' => 2,
                'I24' => 3, 'I28' => 2, 'I30' => 2, 'I31' => 1,
                'I32' => 2, 'I33' => 3, 'I37' => 3, 'I38' => 3,
                'I39' => 3, 'I40' => 2, 'I41' => 2, 'I42' => 2,
                'I43' => 2, 'I58' => 2, 'I66' => 3,
            ],

            // M10 - Rambut Bercabang (23 bahan)
            10 => [
                'I04' => 2, 'I05' => 1, 'I12' => 2, 'I15' => 1,
                'I18' => 3, 'I19' => 2, 'I20' => 2, 'I21' => 3,
                'I27' => 2, 'I35' => 1, 'I36' => 2, 'I53' => 2,
                'I54' => 2, 'I55' => 1, 'I56' => 1, 'I57' => 2,
                'I58' => 2, 'I59' => 2, 'I60' => 2, 'I61' => 2,
                'I65' => 1, 'I68' => 3, 'I69' => 3,
            ],

            // M11 - Rambut Mengembang (21 bahan)
            11 => [
                'I04' => 2, 'I05' => 1, 'I12' => 2, 'I15' => 1,
                'I18' => 2, 'I19' => 2, 'I20' => 2, 'I21' => 2,
                'I27' => 2, 'I53' => 2, 'I54' => 2, 'I55' => 1,
                'I56' => 1, 'I57' => 2, 'I58' => 2, 'I59' => 2,
                'I60' => 2, 'I61' => 2, 'I62' => 1, 'I68' => 3,
                'I69' => 3,
            ],

            // M12 - Gatal pada Kulit Kepala (29 bahan)
            12 => [
                'I02' => 2, 'I03' => 2, 'I07' => 1, 'I10' => 1,
                'I11' => 2, 'I12' => 1, 'I14' => 2, 'I17' => 2,
                'I22' => 1, 'I23' => 3, 'I24' => 1, 'I27' => 1,
                'I28' => 2, 'I32' => 1, 'I33' => 2, 'I37' => 2,
                'I38' => 2, 'I39' => 1, 'I40' => 3, 'I41' => 3,
                'I42' => 2, 'I43' => 3, 'I52' => 1, 'I62' => 2,
                'I63' => 2, 'I64' => 2, 'I65' => 2, 'I66' => 2,
                'I67' => 2,
            ],

            // M13 - Kulit Kepala Iritasi (44 bahan)
            13 => [
                'I02' => 3, 'I03' => 3, 'I04' => 1, 'I06' => 1,
                'I07' => 2, 'I10' => 2, 'I11' => 3, 'I12' => 1,
                'I14' => 2, 'I17' => 3, 'I22' => 1, 'I23' => 2,
                'I24' => 2, 'I27' => 1, 'I28' => 2, 'I30' => 1,
                'I31' => 1, 'I32' => 1, 'I33' => 2, 'I34' => 1,
                'I35' => 1, 'I36' => 2, 'I37' => 2, 'I38' => 2,
                'I39' => 1, 'I40' => 2, 'I41' => 2, 'I42' => 2,
                'I43' => 2, 'I52' => 2, 'I53' => 1, 'I55' => 1,
                'I56' => 1, 'I57' => 1, 'I58' => 1, 'I59' => 1,
                'I60' => 1, 'I61' => 1, 'I62' => 2, 'I63' => 3,
                'I64' => 3, 'I65' => 3, 'I66' => 2, 'I67' => 3,
            ],
        ];

        // Hapus mapping lama, insert yang baru
        DB::table('problem_ingredient_map')->truncate();

        $rows = [];
        $now  = now();

        foreach ($rawMapping as $problemId => $ingredientPriorities) {
            foreach ($ingredientPriorities as $ingCode => $priority) {
                if (! isset($ingMap[$ingCode])) {
                    continue;
                }
                $rows[] = [
                    'hair_problem_id' => $problemId,
                    'ingredient_id'   => $ingMap[$ingCode],
                    'priority'        => $priority,
                    'created_at'      => $now,
                    'updated_at'      => $now,
                ];
            }
        }

        DB::table('problem_ingredient_map')->insert($rows);

        $this->command->info('Mapping berhasil diupdate: ' . count($rows) . ' baris dari 13 masalah.');
    }
}