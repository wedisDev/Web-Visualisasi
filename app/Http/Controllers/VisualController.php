<?php

namespace App\Http\Controllers;

use App\Models\HisMf;
use App\Models\JalurMasukPMB;
use App\Models\MhsTemp;
use App\Models\PendaftaranOnline;
use App\Models\ProdiMf;
use App\Models\SaveSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisualController extends Controller
{
    public function dataCalonMahasiswa(Request $request)
    {
        $total_pendaftar = PendaftaranOnline::count();
        $seluruh_tahun = PendaftaranOnline::whereNotNull('no_test')
            ->select(DB::raw("SUBSTR(no_test, 0, 2) as tahun"))
            ->orderBy('tahun', 'ASC')->distinct()->get();

        $search_tahun = substr($request->get('search_tahun'), -2);
        $tahun_awal = substr($request->get('tahun_awal'), -2);
        $tahun_akhir = substr($request->get('tahun_akhir'), -2);

        if ($request->has('search_tahun')) {
            // $unggah_berkas = [
            //     'sudah' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])
            //         ->whereNull('no_test')->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count(),
            //     'belum' => PendaftaranOnline::whereNull(['path_foto', 'path_rapor', 'path_bayar'])
            //         ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count()
            // ];
            // $verifikasi_berkas = [
            //     'sudah' => PendaftaranOnline::whereNotNull('no_test')
            //         ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count(),
            //     'belum' => PendaftaranOnline::whereNull('no_test')
            //         ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count()
            // ];
            $unggah_berkas = [
                'sudah' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])
                    ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count(),
                'belum' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])
                    ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count()
            ];
            $verifikasi_berkas = [
                'sudah' => PendaftaranOnline::whereNotNull('no_test')
                    ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count(),
                'belum' => PendaftaranOnline::where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count()
            ];
            $membayar_registrasi = [
                'sudah' => count(DB::select("SELECT ss.path_buktiregis, ss.sts_upl_buktiregis
                            FROM pendaftaran_online po JOIN save_sesi ss ON ss.no_test = po.no_test
                            WHERE ss.sts_upl_buktiregis IS NOT NULL
                            AND SUBSTR(po.no_test, 0, 2) = '$search_tahun'")),
                'belum' => count(DB::select("SELECT ss.path_buktiregis, ss.sts_upl_buktiregis
                            FROM pendaftaran_online po JOIN save_sesi ss ON ss.no_test = po.no_test
                            WHERE ss.sts_upl_buktiregis IS NULL
                            AND SUBSTR(po.no_test, 0, 2) = '$search_tahun'"))
            ];
            $registrasi_ulang = [
                'sudah' => count(DB::select("SELECT * FROM pendaftaran_online po 
                WHERE EXISTS (SELECT * FROM mhs_temp mt WHERE mt.no_test = po.no_test AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun')")),
                'belum' => count(DB::select("SELECT * FROM pendaftaran_online po 
                WHERE NOT EXISTS (SELECT * FROM mhs_temp mt WHERE mt.no_test = po.no_test AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun')"))
            ];
            $memiliki_nim = [
                'sudah' => MhsTemp::whereNotNull('nim')
                    ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count(),
                'belum' => MhsTemp::whereNull('nim')
                    ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count()
            ];
            $mengundurkan_diri = [
                'sudah' => collect(DB::select("SELECT mt.no_test FROM his_mf hm JOIN mhs_temp mt ON mt.nim = hm.nim
                        WHERE SUBSTR(mt.no_test, 0, 2) = '$search_tahun' AND (hm.semester = 2 AND hm.sts_mhs = 'O')"))->count(),
                'belum' => collect(DB::select("SELECT mt.no_test FROM his_mf hm JOIN mhs_temp mt ON mt.nim = hm.nim
                        WHERE SUBSTR(mt.no_test, 0, 2) = '$search_tahun' AND (hm.semester = 2 AND hm.sts_mhs = '')"))->count()
            ];
        } elseif ($request->has('tahun_awal') && $request->has('tahun_akhir')) {
            // $unggah_berkas = [
            //     'sudah' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])
            //         ->whereNull('no_test')->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count(),
            //     'belum' => PendaftaranOnline::whereNull(['path_foto', 'path_rapor', 'path_bayar'])
            //         ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count()
            // ];
            // $verifikasi_berkas = [
            //     'sudah' => PendaftaranOnline::whereNotNull('no_test')
            //         ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count(),
            //     'belum' => PendaftaranOnline::whereNull('no_test')
            //         ->where(DB::raw("SUBSTR(no_test, 0, 2)"), '=', $search_tahun)->count()
            // ];
            $unggah_berkas = [
                'sudah' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])
                    ->whereBetween(DB::raw("SUBSTR(no_test, 0, 2)"), [$tahun_awal, $tahun_akhir])->count(),
                'belum' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])
                    ->whereBetween(DB::raw("SUBSTR(no_test, 0, 2)"), [$tahun_awal, $tahun_akhir])->count()
            ];
            $verifikasi_berkas = [
                'sudah' => PendaftaranOnline::whereNotNull('no_test')
                    ->whereBetween(DB::raw("SUBSTR(no_test, 0, 2)"), [$tahun_awal, $tahun_akhir])->count(),
                'belum' => PendaftaranOnline::whereBetween(DB::raw("SUBSTR(no_test, 0, 2)"), [$tahun_awal, $tahun_akhir])->count()
            ];
            $membayar_registrasi = [
                'sudah' => count(DB::select("SELECT ss.path_buktiregis, ss.sts_upl_buktiregis
                            FROM pendaftaran_online po JOIN save_sesi ss ON ss.no_test = po.no_test
                            WHERE ss.sts_upl_buktiregis IS NOT NULL
                            AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")),
                'belum' => count(DB::select("SELECT ss.path_buktiregis, ss.sts_upl_buktiregis
                            FROM pendaftaran_online po JOIN save_sesi ss ON ss.no_test = po.no_test
                            WHERE ss.sts_upl_buktiregis IS NULL
                            AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'"))
            ];
            $registrasi_ulang = [
                'sudah' => count(DB::select("SELECT * FROM pendaftaran_online po 
                WHERE EXISTS (SELECT * FROM mhs_temp mt WHERE mt.no_test = po.no_test AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir')")),
                'belum' => count(DB::select("SELECT * FROM pendaftaran_online po 
                WHERE NOT EXISTS (SELECT * FROM mhs_temp mt WHERE mt.no_test = po.no_test AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir')"))
            ];
            $memiliki_nim = [
                'sudah' => MhsTemp::whereNotNull('nim')
                    ->whereBetween(DB::raw("SUBSTR(no_test, 0, 2)"), [$tahun_awal, $tahun_akhir])->count(),
                'belum' => MhsTemp::whereNull('nim')
                    ->whereBetween(DB::raw("SUBSTR(no_test, 0, 2)"), [$tahun_awal, $tahun_akhir])->count()
            ];
            $mengundurkan_diri = [
                'sudah' => collect(DB::select("SELECT mt.no_test FROM his_mf hm JOIN mhs_temp mt ON mt.nim = hm.nim
                        WHERE SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir' AND (hm.semester = 2 AND hm.sts_mhs = 'O')"))->count(),
                'belum' => collect(DB::select("SELECT mt.no_test FROM his_mf hm JOIN mhs_temp mt ON mt.nim = hm.nim
                        WHERE SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir' AND (hm.semester = 2 AND hm.sts_mhs = '')"))->count()
            ];
        } else {
            $unggah_berkas = [
                'sudah' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])->count(),
                'belum' => count(DB::select("SELECT * FROM PENDAFTARAN_ONLINE
                WHERE PATH_FOTO IS NULL
                AND PATH_RAPOR IS NULL
                AND PATH_BAYAR IS NULL
                AND NO_TEST IS NULL 
                UNION (SELECT * FROM PENDAFTARAN_ONLINE
                WHERE PATH_FOTO IS NOT NULL
                AND PATH_RAPOR IS NULL
                AND PATH_BAYAR IS NOT NULL
                AND NO_TEST IS NULL)"))
            ];
            $verifikasi_berkas = [
                'sudah' => PendaftaranOnline::whereNotNull('no_test')->count(),
                'belum' => PendaftaranOnline::whereNull('no_test')->count()
            ];
            $membayar_registrasi = [
                'sudah' => SaveSesi::whereNotNull(['sts_upl_buktiregis', 'path_buktiregis'])->count(),
                'belum' => SaveSesi::whereNull(['sts_upl_buktiregis', 'path_buktiregis'])->count()
            ];
            $registrasi_ulang = [
                'sudah' => count(DB::select("SELECT * FROM save_sesi ss 
                WHERE EXISTS (SELECT * FROM mhs_temp mt WHERE mt.no_test = ss.no_test)")),
                'belum' => count(DB::select("SELECT * FROM save_sesi ss 
                WHERE NOT EXISTS (SELECT * FROM mhs_temp mt WHERE mt.no_test = ss.no_test)"))
            ];
            $memiliki_nim = [
                'sudah' => MhsTemp::whereNotNull('nim')->count(),
                'belum' => MhsTemp::whereNull('nim')->count()
            ];
            $mengundurkan_diri = [
                'sudah' => HisMf::where('semester', '=', 2)->where('sts_mhs', '=', 'O')->count(),
                'belum' => HisMf::where('semester', '=', 2)->whereNull('sts_mhs')->count()
            ];
            return $mengundurkan_diri;
        }

        return view('pages.dashboard.visual.data_calon_mahasiswa', [
            'tahun' => [
                'semua' => $seluruh_tahun
            ],
            'data' => [
                'unggah_berkas' => [
                    'sudah' => round($unggah_berkas['sudah'] / $total_pendaftar * 100),
                    'belum' => round($unggah_berkas['belum'] / $total_pendaftar * 100)
                ],
                'verifikasi_berkas' => [
                    'sudah' => round($verifikasi_berkas['sudah'] / $unggah_berkas['sudah'] * 100)
                ],
                'membayar_registrasi' => [
                    'sudah' => round($membayar_registrasi['sudah'] / $verifikasi_berkas['sudah'] * 100)
                ],
                'registrasi_ulang' => [
                    'sudah' => round($registrasi_ulang['sudah'] / $membayar_registrasi['sudah'] * 100)
                ],
                'memiliki_nim' => [
                    'sudah' => round($memiliki_nim['sudah'] / $registrasi_ulang['sudah'] * 100)
                ],
                'mengundurkan_diri' => [
                    'sudah' => round($mengundurkan_diri['sudah'] / $registrasi_ulang['sudah'] * 100)
                ]
            ]
        ]);
    }

    public function dataSebaranCalonMahasiswa(Request $request)
    {
        $seluruh_tahun = PendaftaranOnline::whereNotNull('no_test')
            ->select(DB::raw("SUBSTR(no_test, 0, 2) as tahun"))
            ->orderBy('tahun', 'ASC')->distinct()->get();

        $prodi = ProdiMf::orderBy('nama_prodi')->get();
        $prodi_all = [];
        $prodi_laki_laki = [];
        $prodi_perempuan = [];

        $search_tahun = substr($request->get('search_tahun'), -2);
        $tahun_awal = substr($request->get('tahun_awal'), -2);
        $tahun_akhir = substr($request->get('tahun_akhir'), -2);

        if ($request->has('search_tahun')) {
            $jalur_daftar = DB::select("SELECT jmp.nama_jalur, COUNT(ss.no_test) as count FROM jalur_masuk_pmb jmp 
            JOIN save_sesi ss ON SUBSTR(ss.no_test, 3, 2) = jmp.id_jalur
            WHERE SUBSTR(ss.no_test, 0, 2) = '$search_tahun'
            GROUP BY jmp.nama_jalur, SUBSTR(ss.no_test, 3, 2)");

            foreach ($prodi as $loopItem) {
                $prodi_laki_laki[] = [
                    'prodi' => $loopItem->nama_prodi,
                    'count' => DB::select("SELECT COUNT(mt.nim) as count
                    FROM mhs_temp mt WHERE mt.sex = 1 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'
                    AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun'")[0]->count
                ];
                $prodi_perempuan[] = [
                    'prodi' => $loopItem->nama_prodi,
                    'count' => DB::select("SELECT COUNT(mt.nim) as count
                    FROM mhs_temp mt WHERE mt.sex = 2 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'
                    AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun'")[0]->count
                ];
            }

            $tipe_dan_status_sekolah = [
                'sma' => [
                    'negeri' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE '%SMA NEGERI%'
                                AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun'")),
                    'swasta' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE (sm.nama LIKE '%SMA%' OR sm.nama LIKE 'MA%') AND sm.nama NOT LIKE '%SMA NEGERI%'
                                AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun'"))
                ],
                'smk' => [
                    'negeri' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE '%SMK NEGERI%'
                                AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun'")),
                    'swasta' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE '%SMK%' AND sm.nama NOT LIKE '%SMK NEGERI%'
                                AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun'"))
                ],
                'ma' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE 'MA%'
                                AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun'")),
                'lain_lain' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma 
                                WHERE sm.nama NOT LIKE 'MA%' AND sm.nama NOT LIKE '%SMA%' AND sm.nama NOT LIKE '%SMK%'
                                AND SUBSTR(mt.no_test, 0, 2) = '$search_tahun'"))
            ];

            $jurusan_asal_sekolah = [
                'sma' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','17','70') AND SUBSTR(po.no_test, 0, 2) = '$search_tahun'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','17','70') AND SUBSTR(po.no_test, 0, 2) = '$search_tahun'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ],
                'ma' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','70') AND SUBSTR(po.no_test, 0, 2) = '$search_tahun'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','70') AND SUBSTR(po.no_test, 0, 2) = '$search_tahun'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ],
                'smk' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN NOT IN ('15','16','17','70', '43') AND SUBSTR(po.no_test, 0, 2) = '$search_tahun'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN NOT IN ('15','16','17','70', '43') AND SUBSTR(po.no_test, 0, 2) = '$search_tahun'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ]
            ];

            $asal_kota_sekolah = [
                'label' => collect(DB::select("SELECT km.nama AS nama_kota, COUNT(po.no_online) AS count
                                    FROM pendaftaran_online po JOIN kota_mf km ON km.id = po.kota_sma
                                    WHERE SUBSTR(po.no_test, 0, 2) = '$search_tahun'
                                    GROUP BY km.nama ORDER BY COUNT(po.no_online) DESC"))->take(5)->pluck('nama_kota'),
                'data' => collect(DB::select("SELECT km.nama AS nama_kota, COUNT(po.no_online) AS count
                                    FROM pendaftaran_online po JOIN kota_mf km ON km.id = po.kota_sma
                                    WHERE SUBSTR(po.no_test, 0, 2) = '$search_tahun'
                                    GROUP BY km.nama ORDER BY COUNT(po.no_online) DESC"))->take(5)->pluck('count')
            ];
        } elseif ($request->has('tahun_awal') && $request->has('tahun_akhir')) {
            $jalur_daftar = DB::select("SELECT jmp.nama_jalur, COUNT(ss.no_test) as count FROM jalur_masuk_pmb jmp 
            JOIN save_sesi ss ON SUBSTR(ss.no_test, 3, 2) = jmp.id_jalur
            WHERE SUBSTR(ss.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
            GROUP BY jmp.nama_jalur, SUBSTR(ss.no_test, 3, 2)");

            foreach ($prodi as $loopItem) {
                $prodi_laki_laki[] = [
                    'prodi' => $loopItem->nama_prodi,
                    'count' => DB::select("SELECT COUNT(mt.nim) as count
                    FROM mhs_temp mt WHERE mt.sex = 1 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'
                    AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")[0]->count
                ];
                $prodi_perempuan[] = [
                    'prodi' => $loopItem->nama_prodi,
                    'count' => DB::select("SELECT COUNT(mt.nim) as count
                    FROM mhs_temp mt WHERE mt.sex = 2 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'
                    AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")[0]->count
                ];
            }

            $tipe_dan_status_sekolah = [
                'sma' => [
                    'negeri' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE '%SMA NEGERI%'
                                AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")),
                    'swasta' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE (sm.nama LIKE '%SMA%' OR sm.nama LIKE 'MA%') AND sm.nama NOT LIKE '%SMA NEGERI%'
                                AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'"))
                ],
                'smk' => [
                    'negeri' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE '%SMK NEGERI%'
                                AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")),
                    'swasta' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE '%SMK%' AND sm.nama NOT LIKE '%SMK NEGERI%'
                                AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'"))
                ],
                'ma' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE 'MA%'
                                AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")),
                'lain_lain' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma 
                                WHERE sm.nama NOT LIKE 'MA%' AND sm.nama NOT LIKE '%SMA%' AND sm.nama NOT LIKE '%SMK%'
                                AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'"))
            ];

            $jurusan_asal_sekolah = [
                'sma' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','17','70') AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','17','70') AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ],
                'ma' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','70') AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','70') AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ],
                'smk' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN NOT IN ('15','16','17','70', '43') AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN NOT IN ('15','16','17','70', '43') AND SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ]
            ];

            $asal_kota_sekolah = [
                'label' => collect(DB::select("SELECT km.nama AS nama_kota, COUNT(po.no_online) AS count
                            FROM pendaftaran_online po JOIN kota_mf km ON km.id = po.kota_sma
                            WHERE SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
                            GROUP BY km.nama ORDER BY COUNT(po.no_online) DESC"))->take(5)->pluck('nama_kota'),
                'data' => collect(DB::select("SELECT km.nama AS nama_kota, COUNT(po.no_online) AS count
                            FROM pendaftaran_online po JOIN kota_mf km ON km.id = po.kota_sma
                            WHERE SUBSTR(po.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
                            GROUP BY km.nama ORDER BY COUNT(po.no_online) DESC"))->take(5)->pluck('count')
            ];
        } else {

            foreach ($prodi as $loopItem) {
                $prodi_laki_laki[] = [
                    'prodi' => $loopItem->nama_prodi,
                    'count' => DB::select("SELECT COUNT(mt.nim) as count
                    FROM mhs_temp mt WHERE mt.sex = 1 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'")[0]->count
                ];
                $prodi_perempuan[] = [
                    'prodi' => $loopItem->nama_prodi,
                    'count' => DB::select("SELECT COUNT(mt.nim) as count
                    FROM mhs_temp mt WHERE mt.sex = 2 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'")[0]->count
                ];

                $prodi_all[] = [
                    'prodi' => $loopItem->nama_prodi,
                    'chart_id' => str_replace(' ', '_', strtolower($loopItem->nama_prodi)),
                    'laki_laki' => DB::select("SELECT COUNT(mt.nim) as count
                    FROM mhs_temp mt WHERE mt.sex = 1 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'")[0]->count,
                    'perempuan' => DB::select("SELECT COUNT(mt.nim) as count
                    FROM mhs_temp mt WHERE mt.sex = 2 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'")[0]->count
                ];
            }

            $asal_kota_sekolah = [
                'label' => collect(DB::select("SELECT km.nama AS nama_kota, COUNT(po.no_online) AS count
                            FROM pendaftaran_online po JOIN kota_mf km ON km.id = po.kota_sma
                            GROUP BY km.nama ORDER BY COUNT(po.no_online) DESC"))->take(5)->pluck('nama_kota'),
                'data' => collect(DB::select("SELECT km.nama AS nama_kota, COUNT(po.no_online) AS count
                            FROM pendaftaran_online po JOIN kota_mf km ON km.id = po.kota_sma
                            GROUP BY km.nama ORDER BY COUNT(po.no_online) DESC"))->take(5)->pluck('count')
            ];

            $tipe_dan_status_sekolah = [
                'sma' => [
                    'negeri' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE '%SMAN%'
                                OR sm.nama LIKE '%SMA NEGERI%'
                                OR sm.nama LIKE '%SMA Negeri%'
                                OR sm.nama LIKE '%SMUN%'
                                OR sm.nama LIKE '%SMU NEGERI%'")),
                    'swasta' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama NOT LIKE '%SMAN%'
                                AND sm.nama NOT LIKE '%SMA NEGERI%'
                                AND sm.nama NOT LIKE '%SMA Negeri%'
                                AND sm.nama LIKE 'SMA%'
                                OR sm.nama LIKE 'SMU%'"))
                ],
                'smk' => [
                    'negeri' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE '%SMKN%'
                                OR sm.nama LIKE '%SMK NEGERI%'
                                OR sm.nama LIKE '%SMK Negeri%'
                                OR sm.nama LIKE '%STMN%'
                                OR sm.nama LIKE '%STM NEGERI%'
                                OR sm.nama LIKE '%SMEA NEGERI%'")),
                    'swasta' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama NOT LIKE '%SMKN%'
                                AND sm.nama NOT LIKE '%SMK NEGERI%'
                                AND sm.nama NOT LIKE '%SMK Negeri%'
                                AND sm.nama NOT LIKE '%STMN%'
                                AND sm.nama NOT LIKE '%STM NEGERI%'
                                AND sm.nama NOT LIKE '%SMEA NEGERI%'
                                AND sm.nama LIKE 'SMK%'
                                OR sm.nama LIKE 'STM%'
                                OR sm.nama LIKE 'SMEA%'"))
                ],
                'ma' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama LIKE 'MADRASAH%'
                                OR sm.nama LIKE 'MA%'
                                OR sm.nama LIKE 'MADARASYAH%'")),
                'lain_lain' => count(DB::select("SELECT mt.nim, op.kota_sma, op.asal_sma, sm.nama
                                FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                JOIN smu_mf sm ON sm.id = op.asal_sma WHERE sm.nama NOT LIKE 'SMA%'
                                AND sm.nama NOT LIKE 'SMU%'
                                AND sm.nama NOT LIKE 'SMEA%'
                                AND sm.nama NOT LIKE 'SMK%'
                                AND sm.nama NOT LIKE 'STM%'
                                AND sm.nama NOT LIKE 'MADRASAH%'
                                AND sm.nama NOT LIKE 'MA%'
                                AND sm.nama NOT LIKE '%BELUM%'"))
            ];

            $jurusan_asal_sekolah = [
                'sma' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','17','70')
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','17','70')
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ],
                'ma' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','70')
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN IN ('15','16','70')
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ],
                'smk' => [
                    'label' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN NOT IN ('15','16','17','70', '43')
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('nama_jurusan'),
                    'data' => collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
                            FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
                            WHERE js.KD_JURUSAN NOT IN ('15','16','17','70', '43')
                            GROUP BY js.nama ORDER BY COUNT(*) DESC"))->take(5)->pluck('count')
                ]
            ];
        
            $jalur_daftar = DB::select("SELECT jmp.nama_jalur, COUNT(mt.no_test) as count FROM jalur_masuk_pmb jmp 
            JOIN mhs_temp mt ON SUBSTR(mt.no_test, 3, 2) = jmp.id_jalur
            GROUP BY jmp.nama_jalur, SUBSTR(mt.no_test, 3, 2)");
        }

        $program_studi = [
            'semua' => $prodi->pluck('nama_prodi'),
            'laki_laki' => collect($prodi_laki_laki)->pluck('count'),
            'perempuan' => collect($prodi_perempuan)->pluck('count')
        ];

        return view('pages.dashboard.visual.data_sebaran_calon_mahasiswa', [
            'jalur_daftar' => $jalur_daftar,
            'program_studi' => $program_studi,
            'prodi_all' => $prodi_all,
            'tipe_dan_status_sekolah' => $tipe_dan_status_sekolah,
            'jurusan_asal_sekolah' => $jurusan_asal_sekolah,
            'asal_kota_sekolah' => $asal_kota_sekolah,
            'tahun' => [
                'semua' => $seluruh_tahun
            ],
        ]);
    }

    public function asalKotaSekolah()
    {
        $asal_kota_sekolah = collect(DB::select("SELECT km.nama AS nama_kota, COUNT(po.no_online) AS count
        FROM pendaftaran_online po JOIN kota_mf km ON km.id = po.kota_sma
        GROUP BY km.nama ORDER BY COUNT(po.no_online) DESC"));

        return view('pages.dashboard.visual.detail_asal_kota_sekolah', [
            'asal_kota_sekolah' => $asal_kota_sekolah
        ]);
    }

    public function jurusanAsalSekolahSma()
    {
        $jurusan_asal_sekolah_sma = collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
        FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
        WHERE js.KD_JURUSAN IN ('15','16','17','70') 
        GROUP BY js.nama ORDER BY count DESC"));

        return view('pages.dashboard.visual.detail_jurusan_asal_sekolah_sma', [
            'jurusan_asal_sekolah_sma' => $jurusan_asal_sekolah_sma
        ]);
    }

    public function jurusanAsalSekolahMa()
    {
        $jurusan_asal_sekolah_ma = collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
        FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
        WHERE js.KD_JURUSAN IN ('15','16','70')
        GROUP BY js.nama ORDER BY count DESC"));

        return view('pages.dashboard.visual.detail_jurusan_asal_sekolah_ma', [
            'jurusan_asal_sekolah_ma' => $jurusan_asal_sekolah_ma
        ]);
    }

    public function jurusanAsalSekolahSmk()
    {
        $jurusan_asal_sekolah_smk = collect(DB::select("SELECT TRIM(js.nama) AS nama_jurusan, COUNT(*) AS count
        FROM pendaftaran_online po JOIN jurusan_smu js ON js.kd_jurusan = po.jur_sma
        WHERE js.KD_JURUSAN NOT IN ('15','16','17','70', '43')
        GROUP BY js.nama ORDER BY count DESC"));

        return view('pages.dashboard.visual.detail_jurusan_asal_sekolah_smk', [
            'jurusan_asal_sekolah_smk' => $jurusan_asal_sekolah_smk
        ]);
    }
}
