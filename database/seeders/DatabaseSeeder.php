<?php

namespace Database\Seeders;

use App\Models\JalurMasukPMB;
use App\Models\MhsTemp;
use App\Models\PendaftaranOnline;
use App\Models\Pengguna;
use App\Models\ProdiMf;
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

        // seed jalur masuk pmb
        JalurMasukPMB::insert([
            [
                'id_jalur' => '01',
                'nama_jalur' => 'Umum'
            ],
            [
                'id_jalur' => '02',
                'nama_jalur' => 'Kerjasama'
            ],
            [
                'id_jalur' => '03',
                'nama_jalur' => 'Internasional'
            ],
            [
                'id_jalur' => '04',
                'nama_jalur' => 'Beasiswa'
            ],
            [
                'id_jalur' => '05',
                'nama_jalur' => 'Transfer'
            ]
        ]);

        // seed prodi mf
        ProdiMf::insert([
            [
                'id_prodi' => '41010',
                'nama_prodi' => 'Sistem Informasi'
            ],
            [
                'id_prodi' => '41020',
                'nama_prodi' => 'Teknik Komputer'
            ],
            [
                'id_prodi' => '39010',
                'nama_prodi' => 'D3 Sistem Informasi'
            ],
            [
                'id_prodi' => '43010',
                'nama_prodi' => 'Manajemen'
            ],
            [
                'id_prodi' => '43020',
                'nama_prodi' => 'Akuntansi'
            ],
            [
                'id_prodi' => '42010',
                'nama_prodi' => 'DKV'
            ],
            [
                'id_prodi' => '42020',
                'nama_prodi' => 'DESPRO'
            ],
            [
                'id_prodi' => '51016',
                'nama_prodi' => 'PROFITI'
            ]
        ]);

        $jalur_masuk_pmb = JalurMasukPMB::pluck('id_jalur');
        $prodi = ProdiMf::pluck('nama_prodi');

        // seed pendaftaran online
        for ($i = 0; $i < 250; $i++) {
            $no_test = fake()->randomElement([15, 16, 17, 18, 19, 20]) . fake()->randomElement($jalur_masuk_pmb) . fake()->randomElement([15, 16, 17, 18, 19, 20]) . str_pad(($i + 1), 3, '0', STR_PAD_LEFT);

            if ($i % 2 == 0) {
                $pendaftaranOnline = PendaftaranOnline::create([
                    'no_online' => (int) fake()->numerify('###'),
                    'nama_mhs' => fake()->name(),
                    'alamat_mhs' => fake()->address(),
                    'kota_mhs' => fake()->city(),
                    'email' => fake()->email(),
                    'nama_ortu' => fake()->randomElement(['supriadi', 'maryono', 'budi', 'agustinus', 'achmad']),
                    'hp_ortu' => fake()->phoneNumber(),
                    'tahun_lulusan' => fake()->randomElement(['2015', '2016', '2017', '2018', '2019', '2020']),
                    'id_jalur' => fake()->randomElement($jalur_masuk_pmb),
                    'kota_sma' => fake()->city(),
                    'asal_sma' => 'sma negri surabaya 1',
                    'jur_sma' => fake()->randomElement(['rekayasa perngkat lunak', 'teknik mesin', 'teknik elektro', 'tkj']),
                    'pil1' => fake()->randomElement($prodi),
                    'pil2' => fake()->randomElement($prodi),
                    'path_bayar' => 'https://picsum.photos/100/100',
                    'path_kartu' => 'https://picsum.photos/100/100',
                    'path_hasil' => 'https://picsum.photos/100/100',
                    'path_rapor' => 'https://picsum.photos/100/100',
                    'path_foto' => 'https://picsum.photos/100/100',
                    'no_test' => fake()->randomElement([$no_test, null])
                ]);
            } else {
                $pendaftaranOnline = PendaftaranOnline::create([
                    'no_online' => (int) fake()->numerify('###'),
                    'nama_mhs' => fake()->name(),
                    'alamat_mhs' => fake()->address(),
                    'kota_mhs' => fake()->city(),
                    'email' => fake()->email(),
                    'nama_ortu' => fake()->randomElement(['supriadi', 'maryono', 'budi', 'agustinus', 'achmad']),
                    'hp_ortu' => fake()->phoneNumber(),
                    'tahun_lulusan' => fake()->randomElement(['2015', '2016', '2017', '2018', '2019', '2020']),
                    'id_jalur' => fake()->randomElement($jalur_masuk_pmb),
                    'kota_sma' => fake()->city(),
                    'asal_sma' => 'sma negri surabaya 1',
                    'jur_sma' => fake()->randomElement(['rekayasa perngkat lunak', 'teknik mesin', 'teknik elektro', 'tkj']),
                    'pil1' => fake()->randomElement($prodi),
                    'pil2' => fake()->randomElement($prodi),
                    'path_bayar' => null,
                    'path_kartu' => null,
                    'path_hasil' => null,
                    'path_rapor' => null,
                    'path_foto' => null,
                    'no_test' => fake()->randomElement([$no_test, null])
                ]);
            }

            if (!empty($pendaftaranOnline->no_test)) {
                SaveSesi::create([
                    'no_test' => $pendaftaranOnline->no_test,
                    'path_buktiregis' => fake()->randomElement([fake()->imageUrl(), null]),
                    'sts_upl_buktiregis' => fake()->randomElement([fake()->imageUrl(), null])
                ]);

                MhsTemp::create([
                    'no_online' => $pendaftaranOnline->no_online,
                    'no_test' => $pendaftaranOnline->no_test,
                    'nim' => fake()->numerify('###########'),
                    'jalur_masuk' => $pendaftaranOnline->id_jalur,
                    'thn_masuk' => fake()->randomElement(['2015', '2016', '2017', '2018', '2019', '2020']),
                    'nama_mhs' => $pendaftaranOnline->nama_mhs,
                    'sex' => fake()->randomElement([0, 1]),
                    'pil1' => $pendaftaranOnline->pil1,
                    'pil2' => $pendaftaranOnline->pil2,
                    'kota_sma' => $pendaftaranOnline->kota_sma,
                    'asal_sma' => $pendaftaranOnline->asal_sma,
                    'jur_sma' => $pendaftaranOnline->jur_sma
                ]);
            }
        }
    }
}
