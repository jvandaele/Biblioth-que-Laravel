<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $categories = [
            'Bandes dessinées',
            'Cuisine',
            'Droit & économie',
            'Jeunesse',
            'Littérature sentimentale',
            'Policier, suspense, thrillers',
            'SF, Fantasy',
            'Autre'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'label' => $category,
            ]);
        }
    }
}
