<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'is_active' => true,
                'levels' => 'admin'
            ],
            [
                'name' => 'salmaumayna',
                'username' => 'salma',
                'password' => bcrypt('salma'),
                'is_active' => true,
                'levels' => 'admin'
            ],
            [
                'name' => 'livia',
                'username' => 'livia',
                'password' => bcrypt('livia'),
                'is_active' => true,
                'levels' => 'admin'
            ],
            [
                'name' => 'ardiansyah',
                'username' => 'ardiyansyah',
                'password' => bcrypt('ardiyansyah'),
                'is_active' => true,
                'levels' => 'teacher'
            ],
            [
                'name' => 'harun',
                'username' => 'harun',
                'password' => bcrypt('harun'),
                'is_active' => true,
                'levels' => 'teacher'
            ],
        ]);
    }
}
