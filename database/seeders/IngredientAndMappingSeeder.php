<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientAndMappingSeeder extends Seeder
{
    public function run(): void
    {
        // ---------------------------------------------------------------
        // 1. MASTER INGREDIENTS
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
        // 2. PROBLEM → INGREDIENT MAPPING (updated dari Mapping_Fix.xlsx)
        // hair_problem_id: 1=Ketombe, 2=Rambut Rontok, 3=Kulit Kepala Berminyak,
        // 4=Kulit Kepala Kering, 5=Kulit Kepala Sensitif, 6=Rambut Kusam,
        // 7=Rambut Tipis, 8=Rambut Kering, 9=Rambut Berminyak,
        // 10=Rambut Bercabang, 11=Rambut Mengembang,
        // 12=Gatal pada Kulit Kepala, 13=Kulit Kepala Iritasi
        // ---------------------------------------------------------------

        $ingMap = DB::table('ingredients')->pluck('id', 'ingredient_id');

        $rawMapping = [

            // M01 - Ketombe (16 bahan)
            1 => [
                'I28' => 3, // piroctone olamine
                'I14' => 3, // climbazole
                'I33' => 2, // salicylic acid
                'I37' => 2, // zinc gluconate
                'I38' => 2, // zinc lactate
                'I39' => 2, // zinc pca
                'I22' => 2, // lactic acid
                'I40' => 3, // zinc pyrithione
                'I41' => 3, // ketoconazole
                'I42' => 3, // selenium sulfide
                'I43' => 2, // tea tree oil
                'I02' => 2, // aesculus hippocastanum seed extract
                'I24' => 2, // niacinamide
                'I30' => 2, // retinyl palmitate
                'I32' => 2, // rosmarinus officinalis leaf oil
                'I66' => 2, // hamamelis virginiana extract
            ],

            // M02 - Rambut Rontok (27 bahan)
            2 => [
                'I02' => 3, // aesculus hippocastanum seed extract
                'I09' => 2, // caffeine
                'I08' => 2, // biotin
                'I26' => 2, // panax ginseng root extract
                'I16' => 3, // diaminopyrimidine oxide
                'I25' => 3, // oleanolic acid
                'I15' => 3, // copper tripeptide-1
                'I29' => 2, // polygonum multiflorum root extract
                'I31' => 2, // rosmarinus officinalis leaf extract
                'I32' => 2, // rosmarinus officinalis leaf oil
                'I44' => 3, // minoxidil
                'I45' => 3, // aminexil
                'I46' => 3, // procapil
                'I47' => 3, // redensyl
                'I48' => 3, // capixyl
                'I49' => 2, // baicapil
                'I50' => 3, // biotinoyl tripeptide-1
                'I51' => 3, // acetyl tetrapeptide-3
                'I52' => 2, // palmitoyl tetrapeptide-7
                'I01' => 3, // adenosine
                'I05' => 2, // arginine
                'I06' => 2, // ascorbic acid
                'I07' => 2, // azelaic acid
                'I10' => 2, // camellia sinensis leaf extract
                'I35' => 2, // tocopherol
                'I36' => 2, // tocopheryl acetate
                'I61' => 2, // ricinus communis seed oil
            ],

            // M03 - Kulit Kepala Berminyak (18 bahan)
            3 => [
                'I24' => 3, // niacinamide
                'I39' => 3, // zinc pca
                'I37' => 3, // zinc gluconate
                'I38' => 3, // zinc lactate
                'I66' => 3, // hamamelis virginiana extract
                'I28' => 2, // piroctone olamine
                'I14' => 2, // climbazole
                'I33' => 3, // salicylic acid
                'I22' => 2, // lactic acid
                'I40' => 2, // zinc pyrithione
                'I41' => 2, // ketoconazole
                'I42' => 2, // selenium sulfide
                'I43' => 2, // tea tree oil
                'I07' => 2, // azelaic acid
                'I10' => 2, // camellia sinensis leaf extract
                'I30' => 2, // retinyl palmitate
                'I32' => 2, // rosmarinus officinalis leaf oil
                'I58' => 2, // simmondsia chinensis seed oil
            ],

            // M04 - Kulit Kepala Kering (19 bahan)
            4 => [
                'I55' => 3, // sodium hyaluronate
                'I56' => 3, // glycerin
                'I57' => 2, // butyrospermum parkii
                'I58' => 2, // simmondsia chinensis seed oil
                'I59' => 2, // olea europaea oil
                'I60' => 2, // macadamia ternifolia seed oil
                'I61' => 2, // ricinus communis seed oil
                'I02' => 2, // aesculus hippocastanum seed extract
                'I03' => 2, // allantoin
                'I04' => 2, // argania spinosa kernel oil
                'I11' => 2, // centella asiatica extract
                'I12' => 2, // ceramide np
                'I17' => 2, // glycyrrhiza glabra root extract
                'I27' => 2, // panthenol
                'I36' => 2, // tocopheryl acetate
                'I53' => 2, // hydrolyzed collagen
                'I62' => 3, // aloe barbadensis leaf extract
                'I63' => 2, // bisabolol
                'I64' => 2, // chamomilla recutita extract
            ],

            // M05 - Kulit Kepala Sensitif (19 bahan)
            5 => [
                'I03' => 3, // allantoin
                'I11' => 3, // centella asiatica extract
                'I17' => 3, // glycyrrhiza glabra root extract
                'I10' => 2, // camellia sinensis leaf extract
                'I62' => 2, // aloe barbadensis leaf extract
                'I63' => 3, // bisabolol
                'I64' => 3, // chamomilla recutita extract
                'I65' => 3, // calendula officinalis extract
                'I67' => 3, // beta-glucan
                'I02' => 2, // aesculus hippocastanum seed extract
                'I07' => 2, // azelaic acid
                'I23' => 2, // menthol
                'I24' => 2, // niacinamide
                'I36' => 2, // tocopheryl acetate
                'I37' => 2, // zinc gluconate
                'I38' => 2, // zinc lactate
                'I43' => 2, // tea tree oil
                'I52' => 2, // palmitoyl tetrapeptide-7
                'I66' => 2, // hamamelis virginiana extract
            ],

            // M06 - Rambut Kusam (23 bahan)
            6 => [
                'I21' => 2, // keratin
                'I18' => 2, // hydrolyzed keratin
                'I19' => 3, // hydrolyzed silk
                'I20' => 2, // hydrolyzed wheat protein
                'I53' => 2, // hydrolyzed collagen
                'I54' => 3, // silk amino acids
                'I68' => 3, // dimethicone
                'I69' => 3, // amodimethicone
                'I02' => 2, // aesculus hippocastanum seed extract
                'I04' => 3, // argania spinosa kernel oil
                'I06' => 2, // ascorbic acid
                'I12' => 2, // ceramide np
                'I27' => 2, // panthenol
                'I33' => 2, // salicylic acid
                'I35' => 2, // tocopherol
                'I36' => 3, // tocopheryl acetate
                'I55' => 2, // sodium hyaluronate
                'I56' => 2, // glycerin
                'I57' => 2, // butyrospermum parkii
                'I58' => 2, // simmondsia chinensis seed oil
                'I59' => 2, // olea europaea oil
                'I60' => 2, // macadamia ternifolia seed oil
                'I61' => 2, // ricinus communis seed oil
            ],

            // M07 - Rambut Tipis (25 bahan)
            7 => [
                'I01' => 3, // adenosine
                'I09' => 2, // caffeine
                'I08' => 2, // biotin
                'I26' => 2, // panax ginseng root extract
                'I16' => 2, // diaminopyrimidine oxide
                'I25' => 2, // oleanolic acid
                'I15' => 3, // copper tripeptide-1
                'I13' => 1, // chrysin
                'I31' => 2, // rosmarinus officinalis leaf extract
                'I32' => 2, // rosmarinus officinalis leaf oil
                'I44' => 3, // minoxidil
                'I45' => 2, // aminexil
                'I46' => 2, // procapil
                'I47' => 3, // redensyl
                'I48' => 2, // capixyl
                'I49' => 2, // baicapil
                'I50' => 3, // biotinoyl tripeptide-1
                'I51' => 2, // acetyl tetrapeptide-3
                'I02' => 3, // aesculus hippocastanum seed extract
                'I05' => 2, // arginine
                'I07' => 2, // azelaic acid
                'I10' => 2, // camellia sinensis leaf extract
                'I29' => 2, // polygonum multiflorum root extract
                'I52' => 2, // palmitoyl tetrapeptide-7
                'I61' => 2, // ricinus communis seed oil
            ],

            // M08 - Rambut Kering (30 bahan)
            8 => [
                'I21' => 2, // keratin
                'I18' => 2, // hydrolyzed keratin
                'I19' => 2, // hydrolyzed silk
                'I20' => 2, // hydrolyzed wheat protein
                'I05' => 1, // arginine
                'I15' => 1, // copper tripeptide-1
                'I53' => 3, // hydrolyzed collagen
                'I54' => 2, // silk amino acids
                'I55' => 3, // sodium hyaluronate
                'I56' => 3, // glycerin
                'I57' => 3, // butyrospermum parkii
                'I58' => 2, // simmondsia chinensis seed oil
                'I59' => 3, // olea europaea oil
                'I60' => 3, // macadamia ternifolia seed oil
                'I61' => 2, // ricinus communis seed oil
                'I02' => 2, // aesculus hippocastanum seed extract
                'I03' => 2, // allantoin
                'I04' => 3, // argania spinosa kernel oil
                'I11' => 2, // centella asiatica extract
                'I12' => 3, // ceramide np
                'I17' => 2, // glycyrrhiza glabra root extract
                'I27' => 3, // panthenol
                'I36' => 2, // tocopheryl acetate
                'I62' => 3, // aloe barbadensis leaf extract
                'I63' => 2, // bisabolol
                'I64' => 2, // chamomilla recutita extract
                'I65' => 2, // calendula officinalis extract
                'I67' => 2, // beta-glucan
                'I68' => 2, // dimethicone
                'I69' => 2, // amodimethicone
            ],

            // M09 - Rambut Berminyak (18 bahan)
            9 => [
                'I24' => 3, // niacinamide
                'I39' => 3, // zinc pca
                'I37' => 3, // zinc gluconate
                'I38' => 3, // zinc lactate
                'I66' => 3, // hamamelis virginiana extract
                'I07' => 2, // azelaic acid
                'I10' => 2, // camellia sinensis leaf extract
                'I14' => 2, // climbazole
                'I22' => 2, // lactic acid
                'I28' => 2, // piroctone olamine
                'I30' => 2, // retinyl palmitate
                'I32' => 2, // rosmarinus officinalis leaf oil
                'I33' => 3, // salicylic acid
                'I40' => 2, // zinc pyrithione
                'I41' => 2, // ketoconazole
                'I42' => 2, // selenium sulfide
                'I43' => 2, // tea tree oil
                'I58' => 2, // simmondsia chinensis seed oil
            ],

            // M10 - Rambut Bercabang (19 bahan)
            10 => [
                'I21' => 3, // keratin
                'I18' => 3, // hydrolyzed keratin
                'I19' => 2, // hydrolyzed silk
                'I20' => 2, // hydrolyzed wheat protein
                'I05' => 1, // arginine
                'I15' => 1, // copper tripeptide-1
                'I53' => 2, // hydrolyzed collagen
                'I54' => 2, // silk amino acids
                'I04' => 2, // argania spinosa kernel oil
                'I12' => 2, // ceramide np
                'I27' => 2, // panthenol
                'I36' => 2, // tocopheryl acetate
                'I57' => 2, // butyrospermum parkii
                'I58' => 2, // simmondsia chinensis seed oil
                'I59' => 2, // olea europaea oil
                'I60' => 2, // macadamia ternifolia seed oil
                'I61' => 2, // ricinus communis seed oil
                'I68' => 3, // dimethicone
                'I69' => 3, // amodimethicone
            ],

            // M11 - Rambut Mengembang (18 bahan)
            11 => [
                'I21' => 2, // keratin
                'I18' => 2, // hydrolyzed keratin
                'I19' => 2, // hydrolyzed silk
                'I20' => 2, // hydrolyzed wheat protein
                'I05' => 1, // arginine
                'I15' => 1, // copper tripeptide-1
                'I53' => 2, // hydrolyzed collagen
                'I54' => 2, // silk amino acids
                'I68' => 3, // dimethicone
                'I69' => 3, // amodimethicone
                'I04' => 2, // argania spinosa kernel oil
                'I12' => 2, // ceramide np
                'I27' => 2, // panthenol
                'I57' => 2, // butyrospermum parkii
                'I58' => 2, // simmondsia chinensis seed oil
                'I59' => 2, // olea europaea oil
                'I60' => 2, // macadamia ternifolia seed oil
                'I61' => 2, // ricinus communis seed oil
            ],

            // M12 - Gatal pada Kulit Kepala (23 bahan)
            12 => [
                'I03' => 2, // allantoin
                'I11' => 2, // centella asiatica extract
                'I17' => 2, // glycyrrhiza glabra root extract
                'I27' => 1, // panthenol
                'I12' => 1, // ceramide np
                'I10' => 1, // camellia sinensis leaf extract
                'I62' => 2, // aloe barbadensis leaf extract
                'I63' => 2, // bisabolol
                'I64' => 2, // chamomilla recutita extract
                'I65' => 2, // calendula officinalis extract
                'I67' => 2, // beta-glucan
                'I02' => 2, // aesculus hippocastanum seed extract
                'I14' => 2, // climbazole
                'I23' => 3, // menthol
                'I28' => 2, // piroctone olamine
                'I33' => 2, // salicylic acid
                'I37' => 2, // zinc gluconate
                'I38' => 2, // zinc lactate
                'I40' => 3, // zinc pyrithione
                'I41' => 3, // ketoconazole
                'I42' => 2, // selenium sulfide
                'I43' => 3, // tea tree oil
                'I66' => 2, // hamamelis virginiana extract
            ],

            // M13 - Kulit Kepala Iritasi (29 bahan)
            13 => [
                'I28' => 2, // piroctone olamine
                'I14' => 2, // climbazole
                'I33' => 2, // salicylic acid
                'I37' => 2, // zinc gluconate
                'I38' => 2, // zinc lactate
                'I39' => 1, // zinc pca
                'I22' => 1, // lactic acid
                'I40' => 2, // zinc pyrithione
                'I41' => 2, // ketoconazole
                'I42' => 2, // selenium sulfide
                'I43' => 2, // tea tree oil
                'I03' => 3, // allantoin
                'I11' => 3, // centella asiatica extract
                'I17' => 3, // glycyrrhiza glabra root extract
                'I27' => 1, // panthenol
                'I12' => 1, // ceramide np
                'I10' => 2, // camellia sinensis leaf extract
                'I62' => 2, // aloe barbadensis leaf extract
                'I63' => 3, // bisabolol
                'I64' => 3, // chamomilla recutita extract
                'I65' => 3, // calendula officinalis extract
                'I67' => 3, // beta-glucan
                'I02' => 3, // aesculus hippocastanum seed extract
                'I07' => 2, // azelaic acid
                'I23' => 2, // menthol
                'I24' => 2, // niacinamide
                'I36' => 2, // tocopheryl acetate
                'I52' => 2, // palmitoyl tetrapeptide-7
                'I66' => 2, // hamamelis virginiana extract
            ],
        ];

        // Hapus mapping lama dulu, lalu insert yang baru
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

        $this->command->info('Mapping berhasil diupdate: ' . count($rows) . ' baris.');
    }
}