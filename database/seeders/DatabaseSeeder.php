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

        Pengguna::insert([
            [
                "id_pengguna" => "WR_001",
                "nama_pengguna" => "warek",
                "email_pengguna" => "warek@gmail.com",
                "jabatan_pengguna" => "warek",
                "username" => "warek",
                "password" => bcrypt("warek")
            ],
            [
                "id_pengguna" => "ST_001",
                "nama_pengguna" => "staf",
                "email_pengguna" => "staf@gmail.com",
                "jabatan_pengguna" => "staf",
                "username" => "staf",
                "password" => bcrypt("staf")
            ],
            [
                "id_pengguna" => "KB_001",
                "nama_pengguna" => "kabag",
                "email_pengguna" => "kabag@gmail.com",
                "jabatan_pengguna" => "kabag",
                "username" => "kabag",
                "password" => bcrypt("kabag")
            ]
        ]);
    }
}
