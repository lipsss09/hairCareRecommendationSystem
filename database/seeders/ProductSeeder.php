<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/haircare_dataset.csv');
        $csv = array_map(function ($line) {
    return str_getcsv($line, ',');
}, file($file));
        $header = array_shift($csv);
        $header = array_map(function($h) {
    $h = preg_replace('/^\x{FEFF}/u', '', $h); // hapus BOM
    return strtolower(trim($h));
}, $header);

        $insertData = [];
        $categories = DB::table('categories')->pluck('id', 'name');
        //dd($header);
        // dd($csv[0]);
        foreach ($csv as $row) {
            $data = array_combine($header, $row);
            
            $categoryName = trim($data['category']);
            $categoryId = $categories[$categoryName] ?? null;
            $dateRaw = trim($data['date_collected']);
            $name = ucwords($data['name']);

$formattedDate = null;

if (!empty($dateRaw)) {
    $formattedDate = Carbon::createFromFormat('n/j/Y', $dateRaw)
        ->format('Y-m-d');
}

            $insertData[] = [
                'product_id' => $data['product_id'],
                'name' => $name,
                'brand' => $data['brand'],
                'category_id' => $categoryId, 
                'price' => $data['price'],
                'size' => $data['size_value'],
                'size_unit' => $data['size_unit'],
                'ingredients' => $data['ingredients'],
                'key_ingredients' => $data['key_ingredients'],
                'image_url' => $data['image_url'] ?? null,
                'source' => $data['source'] ?? null,
                'collected_date' => $formattedDate,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('products')->truncate();
        DB::table('products')->insert($insertData);
    }
}