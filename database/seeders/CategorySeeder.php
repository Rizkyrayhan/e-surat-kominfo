<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'OPD',
            'Kecamatan',
            'Kelurahan',
            'Sekolah',
            'Instansi lainnya'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::firstOrCreate(['nama_kategori' => $category]);
        }

        // Assign existing OPD accounts to 'OPD' category
        $opdCategory = \App\Models\Category::where('nama_kategori', 'OPD')->first();
        if ($opdCategory) {
            \App\Models\User::where('role', 'opd')
                            ->whereNull('category_id')
                            ->update(['category_id' => $opdCategory->id]);
        }
    }
}
