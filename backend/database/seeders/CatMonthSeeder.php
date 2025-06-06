<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'January', 'active' => true],
            ['name' => 'February', 'active' => true],
            ['name' => 'March', 'active' => true],
            ['name' => 'April', 'active' => true],
            ['name' => 'May', 'active' => true],
            ['name' => 'June', 'active' => true],
            ['name' => 'July', 'active' => true],
            ['name' => 'August', 'active' => true],
            ['name' => 'September', 'active' => true],
            ['name' => 'October', 'active' => true],
            ['name' => 'November', 'active' => true],
            ['name' => 'December', 'active' => true],
        ];
        foreach ($values as $value) {
            DB::table('cat_month')->updateOrInsert(
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
