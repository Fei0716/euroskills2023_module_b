<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'username' => 'demo1',
                'password' => Hash::make('skills2023d1'),
            ],
            [
                'username' => 'demo2',
                'password' => Hash::make('skills2023d2'),
            ],
        ]);
    }
}
