<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatWeekMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'First', 'active' => true],
            ['name' => 'Second', 'active' => true],
            ['name' => 'Third', 'active' => true],
            ['name' => 'Fourth', 'active' => true],
            ['name' => 'Last', 'active' => true],
        ];
        foreach ($values as $value) {
            DB::table('cat_week_month')->updateOrInsert(
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
