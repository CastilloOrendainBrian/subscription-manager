<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Sunday', 'active' => true],
            ['name' => 'Monday', 'active' => true],
            ['name' => 'Tuesday', 'active' => true],
            ['name' => 'Wednesday', 'active' => true],
            ['name' => 'Thursday', 'active' => true],
            ['name' => 'Friday', 'active' => true],
            ['name' => 'Saturday', 'active' => true],
        ];
        foreach ($values as $value) {
            DB::table('cat_day')->updateOrInsert(
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
