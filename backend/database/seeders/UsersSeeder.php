<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Brian Castillo', 'email' => 'brian@mail.com', 'password' => '1234567a'],
        ];
        foreach ($values as $value) {
            DB::table('users')->updateOrInsert(
                ['email' => $value['email']],
                [
                    'name' => $value['name'],
                    'email' => $value['email'],
                    'password' => Hash::make($value['password']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
