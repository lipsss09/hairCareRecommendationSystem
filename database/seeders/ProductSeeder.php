<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/produk_rambut_processed.csv');
        $csv = array_map('str_getcsv', file($file));
        $header = array_shift($csv);
        $header = array_map(function($h) {
    $h = preg_replace('/^\x{FEFF}/u', '', $h); // hapus BOM
    return strtolower(trim($h));
}, $header);

        $insertData = [];
        $categories = DB::table('categories')->pluck('id', 'name');

        foreach ($csv as $row) {
            $data = array_combine($header, $row);
            //dd($header);
            $categoryName = trim($data['category_fix']);
            $categoryId = $categories[$categoryName] ?? null;
            $dateRaw = trim($data['date_collected']);

$formattedDate = null;

if (!empty($dateRaw)) {
    $formattedDate = Carbon::createFromFormat('n/j/Y', $dateRaw)
        ->format('Y-m-d');
}

            $insertData[] = [
                'product_id' => $data['product_id'],
                'name' => $data['name'],
                'brand' => $data['brand_normalized'],
                'category_id' => $categoryId, 
                'price' => $data['price_normalized'],
                'size' => $data['size_value'],
                'size_unit' => $data['size_units'],
                'ingredients' => $data['ingredients_normalized'],
                'key_ingredients' => $data['key_ingredients'],
                'image_url' => $data['image_url'] ?? null,
                'source' => $data['source'] ?? null,
                'collected_date' => $formattedDate,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($insertData);
    }
}