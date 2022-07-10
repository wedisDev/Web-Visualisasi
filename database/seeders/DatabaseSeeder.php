<?php

namespace Database\Seeders;

use App\Models\PendaftaranOnline;
use App\Models\Pengguna;
use App\Models\SaveSesi;
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
        // seed pengguna
        Pengguna::insert([
            [
                'id_pengguna' => 'WR_001',
                'nama_pengguna' => 'warek',
                'email_pengguna' => 'warek@gmail.com',
                'jabatan_pengguna' => 'warek',
                'username' => 'warek',
                'password' => bcrypt('warek')
            ],
            [
                'id_pengguna' => 'ST_001',
                'nama_pengguna' => 'staf',
                'email_pengguna' => 'staf@gmail.com',
                'jabatan_pengguna' => 'staf',
                'username' => 'staf',
                'password' => bcrypt('staf')
            ],
            [
                'id_pengguna' => 'KB_001',
                'nama_pengguna' => 'kabag',
                'email_pengguna' => 'kabag@gmail.com',
                'jabatan_pengguna' => 'kabag',
                'username' => 'kabag',
                'password' => bcrypt('kabag')
            ]
        ]);

        // seed pendaftaran online
        for ($i = 0; $i < 250; $i++) {
            if ($i % 2 == 0) {
                $pendaftaranOnline = PendaftaranOnline::create([
                    'nama_mhs' => fake()->name(),
                    'alamat_mhs' => fake()->address(),
                    'kota_mhs' => fake()->city(),
                    'email' => fake()->email(),
                    'nama_ortu' => fake()->randomElement(['supriadi', 'maryono', 'budi', 'agustinus', 'achmad']),
                    'hp_ortu' => fake()->phoneNumber(),
                    'tahun_lulusan' => fake()->randomElement(['2015', '2016', '2017', '2018', '2019', '2020', '2021']),
                    'kota_sma' => fake()->city(),
                    'asal_sma' => 'sma negri surabaya 1',
                    'jur_sma' => fake()->randomElement(['rekayasa perngkat lunak', 'teknik mesin', 'teknik elektro', 'tkj']),
                    'pil1' => fake()->randomElement(['S1 Sistem Informasi', 'D3 Sistem Informasi', 'S1 Akuntansi', 'S1 Design Kreative Visual']),
                    'pil2' => fake()->randomElement(['S1 Sistem Informasi', 'D3 Sistem Informasi', 'S1 Akuntansi', 'S1 Design Kreative Visual']),
                    'path_bayar' => fake()->imageUrl(),
                    'path_kartu' => fake()->imageUrl(),
                    'path_hasil' => fake()->imageUrl(),
                    'path_rapor' => fake()->imageUrl(),
                    'path_foto' => fake()->imageUrl(),
                    'no_test' => fake()->randomElement(['NT_' . $i, null])
                ]);
            } else {
                $pendaftaranOnline = PendaftaranOnline::create([
                    'nama_mhs' => fake()->name(),
                    'alamat_mhs' => fake()->address(),
                    'kota_mhs' => fake()->city(),
                    'email' => fake()->email(),
                    'nama_ortu' => fake()->randomElement(['supriadi', 'maryono', 'budi', 'agustinus', 'achmad']),
                    'hp_ortu' => fake()->phoneNumber(),
                    'tahun_lulusan' => fake()->randomElement(['2015', '2016', '2017', '2018', '2019', '2020', '2021']),
                    'kota_sma' => fake()->city(),
                    'asal_sma' => 'sma negri surabaya 1',
                    'jur_sma' => fake()->randomElement(['rekayasa perngkat lunak', 'teknik mesin', 'teknik elektro', 'tkj']),
                    'pil1' => fake()->randomElement(['S1 Sistem Informasi', 'D3 Sistem Informasi', 'S1 Akuntansi', 'S1 Design Kreative Visual']),
                    'pil2' => fake()->randomElement(['S1 Sistem Informasi', 'D3 Sistem Informasi', 'S1 Akuntansi', 'S1 Design Kreative Visual']),
                    'path_bayar' => null,
                    'path_kartu' => null,
                    'path_hasil' => null,
                    'path_rapor' => null,
                    'path_foto' => null,
                    'no_test' => fake()->randomElement(['NT_' . $i, null])
                ]);
            }

            SaveSesi::create([
                'no_test' => fake()->randomElement(['NT_' . $i, null]),
                'path_buktiregis' => fake()->randomElement([fake()->imageUrl(), null]),
                'sts_upl_buktiregis' => fake()->randomElement([fake()->imageUrl(), null])
            ]);
        }
    }
}
