<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Pengguna::create([
            "id_pengguna" => "ST_001",
            "nama_pengguna" => "pak budi",
            "email_pengguna" => "budi@gmail.com",
            "jabatan_pengguna" => "staf",
            "username" => "staf",
            "password" => bcrypt("staf")
        ]);
    }
}
