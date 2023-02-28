<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'nama'=> 'admin',
            'username'=> 'admin',
            'password'=> bcrypt('admin'),
            'nik'=>'7371',
            'tlp' => '62',
            'level' => 'admin'
        ]);
        User::create([
            'nama'=> 'petugas',
            'username'=> 'petugas',
            'password'=> bcrypt('petugas'),
            'nik'=>'737',
            'tlp' => '628',
            'level' => 'petugas'
        ]);
        User::create([
            'nama'=> 'panji',
            'username'=> 'panji',
            'password'=> bcrypt('panji'),
            'nik'=>'73711208050005',
            'tlp' => '6282154658408',
            'level' => 'masyarakat'
        ]);
    }
}
