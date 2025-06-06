<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Peso Mexicano', 'acronym' => 'MXN', 'active' => true],
            ['name' => 'United States Dollar', 'acronym' => 'USD', 'active' => true],
        ];
        foreach ($values as $value) {
            DB::table('cat_currency')->updateOrInsert(
                ['acronym' => $value['acronym']],
                [
                    'name' => $value['name'],
                    'acronym' => $value['acronym'],
                    'active' => $value['active'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
