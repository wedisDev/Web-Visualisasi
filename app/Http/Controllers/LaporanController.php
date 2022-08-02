<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranOnline;
use App\Models\ProdiMf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $seluruh_tahun = PendaftaranOnline::whereNotNull('no_test')
            ->select(DB::raw("SUBSTR(no_online, 3, 2) as tahun"))
            ->orderBy('tahun', 'ASC')->distinct()->get();

        return view('pages.dashboard.laporan.index', [
            'tahun' => [
                'semua' => $seluruh_tahun
            ]
        ]);
    }

    public function laporanGeneratePDF(Request $request)
    {
        $prodi = ProdiMf::orderBy('fakultas', 'DESC')->get();
        $tahun_awal = substr($request->get('tahun_awal'), -2);
        $tahun_akhir = substr($request->get('tahun_akhir'), -2);
        $data_calon_mahasiswa = [];
        $data_sebaran_calon_mahasiswa = [];
        $data_prodi = [];

        if ($request->has('tahun_awal') && $request->has('tahun_akhir')) {
            foreach ($prodi as $loopItem) {
                $data_sebaran_calon_mahasiswa[] = [
                    'prodi' => ProdiMf::where('id_prodi', '=', $loopItem->id_prodi)->first('nama_prodi')->nama_prodi,
                    'total_daftar'  =>  DB::select(DB::raw("SELECT COUNT(mt.nim) as count
                                        FROM mhs_temp mt WHERE SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'
                                        AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'"))[0]->count,
                    'laki_laki'     =>  DB::select(DB::raw("SELECT COUNT(mt.nim) as count
                                        FROM mhs_temp mt WHERE (SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi' AND mt.sex = 1)
                                        AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'"))[0]->count,
                    'perempuan'     =>  DB::select(DB::raw("SELECT COUNT(mt.nim) as count
                                        FROM mhs_temp mt WHERE (SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi' AND mt.sex = 2)
                                        AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'"))[0]->count
                ];
            }

            foreach ($prodi as $loopItem) {
                $data_calon_mahasiswa[] = [
                    'prodi' => ProdiMf::where('id_prodi', '=', $loopItem->id_prodi)->first('nama_prodi')->nama_prodi,
                    'total_daftar' => DB::select(DB::raw("SELECT COUNT(mt.nim) as count
                                        FROM mhs_temp mt WHERE SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'
                                        AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'"))[0]->count,
                    'unggah_berkas' => DB::select("SELECT COUNT(*) AS count
                                        FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                        WHERE (op.path_foto IS NOT NULL AND op.path_rapor IS NOT NULL AND op.path_bayar IS NOT NULL AND op.no_test IS NOT NULL)
                                        AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi' AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")[0]->count,
                    'verifikasi_berkas' => DB::select("SELECT COUNT(*) AS count
                                        FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                        WHERE (op.no_test IS NOT NULL)
                                        AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi' AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")[0]->count,
                    'membayar_regist' => DB::select("SELECT COUNT(*) AS count
                                        FROM mhs_temp mt JOIN save_sesi ss ON ss.no_test = mt.no_test
                                        WHERE SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi' AND ss.sts_upl_buktiregis IS NOT NULL 
                                        AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")[0]->count,
                    'registrasi_ulang' => DB::select("SELECT COUNT(*) AS count FROM pendaftaran_online po 
                                        WHERE EXISTS (SELECT * FROM mhs_temp mt WHERE mt.no_test = po.no_test AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'
                                        AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir')")[0]->count,
                    'memiliki_nim' => DB::select("SELECT COUNT(*) AS count FROM mhs_temp mt 
                                        WHERE SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi' AND mt.nim IS NOT NULL
                                        AND SUBSTR(mt.no_test, 0, 2) BETWEEN '$tahun_awal' AND '$tahun_akhir'")[0]->count,
                ];
            }
        } else {
            foreach ($prodi as $loopItem) {
                $data_sebaran_calon_mahasiswa[] = [
                    'prodi' => ProdiMf::where('id_prodi', '=', $loopItem->id_prodi)->first('nama_prodi')->nama_prodi,
                    'total_daftar'  =>  DB::select(DB::raw("SELECT COUNT(mt.nim) as count
                                        FROM mhs_temp mt WHERE SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'"))[0]->count,
                    'laki_laki'     =>  DB::select(DB::raw("SELECT COUNT(mt.nim) as count
                                        FROM mhs_temp mt WHERE mt.sex = 1 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'"))[0]->count,
                    'perempuan'     =>  DB::select(DB::raw("SELECT COUNT(mt.nim) as count
                                        FROM mhs_temp mt WHERE mt.sex = 2 AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'"))[0]->count
                ];
            }

            foreach ($prodi as $loopItem) {
                $data_calon_mahasiswa[] = [
                    'prodi' => ProdiMf::where('id_prodi', '=', $loopItem->id_prodi)->first('nama_prodi')->nama_prodi,
                    'total_daftar' => DB::select(DB::raw("SELECT COUNT(mt.nim) as count
                                        FROM mhs_temp mt WHERE SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'"))[0]->count,
                    'unggah_berkas' => DB::select("SELECT COUNT(*) AS count
                                        FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                        WHERE (op.path_foto IS NOT NULL AND op.path_rapor IS NOT NULL AND op.path_bayar IS NOT NULL AND op.no_test IS NOT NULL)
                                        AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'")[0]->count,
                    'verifikasi_berkas' => DB::select("SELECT COUNT(*) AS count
                                        FROM mhs_temp mt JOIN pendaftaran_online op ON op.no_test = mt.no_test
                                        WHERE (op.no_test IS NOT NULL)
                                        AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi'")[0]->count,
                    'membayar_regist' => DB::select("SELECT COUNT(*) AS count
                                        FROM mhs_temp mt JOIN save_sesi ss ON ss.no_test = mt.no_test
                                        WHERE SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi' AND ss.sts_upl_buktiregis IS NOT NULL")[0]->count,
                    'registrasi_ulang' => DB::select("SELECT COUNT(*) AS count FROM pendaftaran_online po 
                                        WHERE EXISTS (SELECT * FROM mhs_temp mt WHERE mt.no_test = po.no_test AND SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi')")[0]->count,
                    'memiliki_nim' => DB::select("SELECT COUNT(*) AS count FROM mhs_temp mt 
                                        WHERE SUBSTR(mt.nim, 3, 5) = '$loopItem->id_prodi' AND mt.nim IS NOT NULL")[0]->count
                ];
            }
        }

        // data prodi semua
        foreach($prodi as $loopItem) {
            $data_prodi[] = [
                'id_prodi' => $loopItem->id_prodi,
                'nama_prodi' => $loopItem->nama_prodi,
                'fakultas' => $loopItem->fakultas,
            ];
        };

        if ($request->get('search_data') == 'data_calon_mahasiswa') {
            $pdf = Pdf::loadView('laporan.pdf_data_calon_mahasiswa', [
                'title' => 'data_calon_mahasiswa_' . date_format(Carbon::now(), 'dmy'),
                'data_calon_mahasiswa' => $data_calon_mahasiswa,
                'data_prodi' => $data_prodi
            ])->setPaper('a4', 'portrait');
        } else if ($request->get('search_data') == 'data_sebaran_calon_mahasiswa') {
            $pdf = Pdf::loadView('laporan.pdf_data_sebaran_calon_mahasiswa', [
                'title' => 'data_sebaran_calon_mahasiswa_' . date_format(Carbon::now(), 'dmy'),
                'data_sebaran_calon_mahasiswa' => $data_sebaran_calon_mahasiswa,
                'data_prodi' => $data_prodi
            ])->setPaper('a4', 'portrait');
        }

        return $pdf->stream();
    }
}
