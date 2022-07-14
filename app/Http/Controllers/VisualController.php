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
        $total_pendaftar = PendaftaranOnline::when($request->has('search_tahun'), function ($query) use ($request) {
            return $query->where('tahun_lulusan', '=', $request->search_tahun);
        })->count();
        $seluruh_tahun = PendaftaranOnline::whereNotNull('no_test')
            ->select(DB::raw("SUBSTR(no_test, 0, 2) as tahun"))
            ->orderBy('tahun', 'ASC')->distinct()->get();

        $unggah_berkas = [
            'sudah' => round(PendaftaranOnline::when($request->has('search_tahun'), function ($query) use ($request) {
                return $query->where('tahun_lulusan', '=', $request->search_tahun);
            })->whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])->whereNull('no_test')->count() * 100 / $total_pendaftar),
            'belum' => round(PendaftaranOnline::when($request->has('search_tahun'), function ($query) use ($request) {
                return $query->where('tahun_lulusan', '=', $request->search_tahun);
            })->whereNull(['path_foto', 'path_rapor', 'path_bayar'])->count() * 100 / $total_pendaftar)
        ];
        $verifikasi_berkas = [
            'sudah' => round(PendaftaranOnline::when($request->has('search_tahun'), function ($query) use ($request) {
                return $query->where('tahun_lulusan', '=', $request->search_tahun);
            })->whereNotNull('no_test')->count() * 100 / $total_pendaftar),
            'belum' => round(PendaftaranOnline::when($request->has('search_tahun'), function ($query) use ($request) {
                return $query->where('tahun_lulusan', '=', $request->search_tahun);
            })->whereNull('no_test')->count() * 100 / $total_pendaftar)
        ];
        $registrasi_berkas = [
            'sudah' => round(DB::table('save_sesi')
                ->join('pendaftaran_online', 'save_sesi.no_test', 'pendaftaran_online.no_test')
                ->when($request->has('search_tahun'), function ($query) use ($request) {
                    return $query->where('tahun_lulusan', '=', $request->search_tahun);
                })->whereNotNull('sts_upl_buktiregis')->count() * 100 / $total_pendaftar),
            'belum' => round(DB::table('save_sesi')
                ->join('pendaftaran_online', 'save_sesi.no_test', 'pendaftaran_online.no_test')
                ->when($request->has('search_tahun'), function ($query) use ($request) {
                    return $query->where('tahun_lulusan', '=', $request->search_tahun);
                })->whereNull('sts_upl_buktiregis')->count() * 100 / $total_pendaftar)
        ];

        return view('pages.dashboard.visual.data_calon_mahasiswa', [
            'tahun' => [
                'semua' => $seluruh_tahun,
                'pertama' => '20' . $seluruh_tahun[0]['tahun'],
                'akhir' => '20' . $seluruh_tahun[count($seluruh_tahun) - 1]['tahun']
            ],
            'data' => [
                'unggah_berkas' => $unggah_berkas,
                'verifikasi_berkas' => $verifikasi_berkas,
                'registrasi_berkas' => $registrasi_berkas,
                // 'registrasi_ulang' => ['sudah' => 50, 'belum' => 50],
                // 'memiliki_nim' => ['sudah' => 50, 'belum' => 50],
                // 'mengundurkan_diri' => ['sudah' => 40, 'belum' => 10]
            ]
        ]);
    }

    public function dataSebaranCalonMahasiswa(Request $request)
    {
        $total_pendaftar = PendaftaranOnline::when($request->has('search_tahun'), function ($query) use ($request) {
            return $query->where('tahun_lulusan', '=', $request->search_tahun);
        })->count();
        $seluruh_tahun = PendaftaranOnline::whereNotNull('no_test')
            ->select(DB::raw("SUBSTR(no_test, 0, 2) as tahun"))
            ->orderBy('tahun', 'ASC')->distinct()->get();

        $jalur_daftar = DB::select("SELECT jmp.nama_jalur, ROUND((COUNT(jmp.nama_jalur) * 100 / (SELECT COUNT(*) FROM mhs_temp))) AS count FROM jalur_masuk_pmb jmp 
        JOIN mhs_temp mt ON SUBSTR(mt.no_test, 3, 2) = jmp.id_jalur
        GROUP BY jmp.nama_jalur, SUBSTR(mt.no_test, 3, 2)");

        $program_studi = [
            'semua' => ProdiMf::pluck('nama_prodi'),
            'perempuan' => collect(DB::select("SELECT COUNT(mt.sex) as count
            FROM prodi_mf pm JOIN mhs_temp mt ON mt.pil1 = pm.nama_prodi
            WHERE mt.sex = 0
            GROUP BY pm.nama_prodi, mt.sex
            ORDER BY pm.nama_prodi"))->pluck('count'),
            'laki_laki' => collect(DB::select("SELECT COUNT(mt.sex) as count
            FROM prodi_mf pm JOIN mhs_temp mt ON mt.pil1 = pm.nama_prodi
            WHERE mt.sex = 1
            GROUP BY pm.nama_prodi, mt.sex
            ORDER BY pm.nama_prodi"))->pluck('count')
        ];

        return view('pages.dashboard.visual.data_sebaran_calon_mahasiswa', [
            'jalur_daftar' => $jalur_daftar,
            'program_studi' => $program_studi,
            'tahun' => [
                'semua' => $seluruh_tahun,
                'pertama' => '20' . $seluruh_tahun[0]['tahun'],
                'akhir' => '20' . $seluruh_tahun[count($seluruh_tahun) - 1]['tahun']
            ],
        ]);
    }
}
