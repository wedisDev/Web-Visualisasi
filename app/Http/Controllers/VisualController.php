<?php

namespace App\Http\Controllers;

use App\Models\JalurMasukPMB;
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

        $unggah_berkas = [
            'sudah' => PendaftaranOnline::whereNotNull('path_bayar')->whereNull('no_test')->count(),
            'belum' => PendaftaranOnline::whereNull(['path_bayar', 'path_kartu', 'path_hasil', 'path_rapor', 'path_foto'])->count()
        ];
        $verifikasi_berkas = [
            'sudah' => PendaftaranOnline::whereNotNull('path_bayar')->whereNotNull('no_test')->count(),
            'belum' => PendaftaranOnline::whereNotNull('path_bayar')->whereNull('no_test')->count()
        ];
        $membayar_registrasi = [
            'sudah' => DB::table('save_sesi')
                ->join('pendaftaran_online', 'save_sesi.no_test', 'pendaftaran_online.no_test')
                ->whereNotNull(['path_buktiregis', 'sts_upl_buktiregis'])->count(),
            'belum' => DB::table('save_sesi')
                ->join('pendaftaran_online', 'save_sesi.no_test', 'pendaftaran_online.no_test')
                ->whereNotNull('path_buktiregis')
                ->whereNull('sts_upl_buktiregis')->count()
        ];

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
                    'sudah' => round($verifikasi_berkas['sudah'] / $unggah_berkas['sudah'] * 100),
                    'belum' => round($verifikasi_berkas['belum'] / $unggah_berkas['belum'] * 100)
                ],
                'membayar_registrasi' => [
                    'sudah' => round($membayar_registrasi['sudah'] / $verifikasi_berkas['sudah'] * 100),
                    'belum' => round($membayar_registrasi['belum'] / $verifikasi_berkas['belum'] * 100)
                ]
                // 'registrasi_ulang' => ['sudah' => 50, 'belum' => 50],
                // 'memiliki_nim' => ['sudah' => 50, 'belum' => 50],
                // 'mengundurkan_diri' => ['sudah' => 40, 'belum' => 10]
            ]
        ]);
    }

    public function dataSebaranCalonMahasiswa(Request $request)
    {
        $seluruh_tahun = PendaftaranOnline::whereNotNull('no_test')
            ->select(DB::raw("SUBSTR(no_test, 0, 2) as tahun"))
            ->orderBy('tahun', 'ASC')->distinct()->get();
        $search_tahun = substr($request->get('search_tahun'), -2);
        $tahun_awal = substr($request->get('tahun_awal'), -2);
        $tahun_akhir = substr($request->get('tahun_akhir'), -2);

        if ($request->has('search_tahun')) {
            $jalur_daftar = DB::select("SELECT jmp.nama_jalur, ROUND((COUNT(jmp.nama_jalur) * 100 / (SELECT COUNT(*) FROM mhs_temp))) AS count FROM jalur_masuk_pmb jmp 
            JOIN mhs_temp mt ON SUBSTR(mt.no_test, 3, 2) = jmp.id_jalur
            WHERE SUBSTR(mt.no_test, 0, 2) = '$search_tahun'
            GROUP BY jmp.nama_jalur, SUBSTR(mt.no_test, 3, 2)");
        } elseif ($request->has('tahun_awal') && $request->has('tahun_akhir')) {
            $jalur_daftar = DB::select("SELECT jmp.nama_jalur, ROUND((COUNT(jmp.nama_jalur) * 100 / (SELECT COUNT(*) FROM mhs_temp))) AS count FROM jalur_masuk_pmb jmp 
            JOIN mhs_temp mt ON SUBSTR(mt.no_test, 3, 2) = jmp.id_jalur
            WHERE SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'
            GROUP BY jmp.nama_jalur, SUBSTR(mt.no_test, 3, 2)");
        } else {
            $jalur_daftar = DB::select("SELECT jmp.nama_jalur, ROUND((COUNT(jmp.nama_jalur) * 100 / (SELECT COUNT(*) FROM mhs_temp))) AS count FROM jalur_masuk_pmb jmp 
            JOIN mhs_temp mt ON SUBSTR(mt.no_test, 3, 2) = jmp.id_jalur
            GROUP BY jmp.nama_jalur, SUBSTR(mt.no_test, 3, 2)");
        }

        $program_studi = [
            'semua' => ProdiMf::pluck('nama_prodi'),
            'perempuan' => collect(DB::select("SELECT COUNT(mt.sex) as count
            FROM prodi_mf pm JOIN mhs_temp mt ON mt.pil1 = pm.nama_prodi OR mt.pil2 = pm.nama_prodi
            WHERE mt.sex = 0
            GROUP BY pm.nama_prodi, mt.sex
            ORDER BY pm.nama_prodi"))->pluck('count'),
            'laki_laki' => collect(DB::select("SELECT COUNT(mt.sex) as count
            FROM prodi_mf pm JOIN mhs_temp mt ON mt.pil1 = pm.nama_prodi OR mt.pil2 = pm.nama_prodi
            WHERE mt.sex = 1
            GROUP BY pm.nama_prodi, mt.sex
            ORDER BY pm.nama_prodi"))->pluck('count')
        ];

        return view('pages.dashboard.visual.data_sebaran_calon_mahasiswa', [
            'jalur_daftar' => $jalur_daftar,
            'program_studi' => $program_studi,
            'tahun' => [
                'semua' => $seluruh_tahun
            ],
        ]);
    }
}
