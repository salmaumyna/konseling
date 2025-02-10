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
                'name' => 'Sri Prihantoro',
                'username' => 'sriprihantoro',
                'password' => bcrypt('sri'),
                'is_active' => true,
                'levels' => 'admin', 'teacher'
            ],
            [
                'name' => 'Titin Suryaningsih',
                'username' => 'titinsuryaningsih',
                'password' => bcrypt('titin'),
                'is_active' => true,
                'levels' => 'teacher'
            ],
            [
                'name' => 'Ana Rosaenah',
                'username' => 'anarosaenah',
                'password' => bcrypt('ana'),
                'is_active' => true,
                'levels' => 'teacher'
            ],
            [
                'name' => 'Farhatun Aathiroh',
                'username' => 'farhatunaathiroh',
                'password' => bcrypt('farhatun'),
                'is_active' => true,
                'levels' => 'teacher'
            ],
            [
                'name' => 'Selly Apriliani',
                'username' => 'sellyapriliani',
                'password' => bcrypt('selly'),
                'is_active' => true,
                'levels' => 'teacher'
            ],
            [
                'name' => 'Mufidah Istiqomah',
                'username' => 'mufidahistiqomah',
                'password' => bcrypt('isti'),
                'is_active' => true,
                'levels' => 'teacher'
            ],
        ]);
    }
}
