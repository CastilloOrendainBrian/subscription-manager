<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatTimeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Day', 'active' => true],
            ['name' => 'Week', 'active' => true],
            ['name' => 'Month', 'active' => true],
            ['name' => 'Year', 'active' => true],
        ];
        foreach ($values as $value) {
            DB::table('cat_time_unit')->updateOrInsert(
                ['name' => $value['name']],
                [
                    'name' => $value['name'],
                    'active' => $value['active'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
