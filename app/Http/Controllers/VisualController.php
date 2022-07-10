<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranOnline;
use App\Models\SaveSesi;
use Illuminate\Http\Request;

class VisualController extends Controller
{
    public function dataCalonMahasiswa()
    {
        $total_pendaftar = PendaftaranOnline::count();

        $unggah_berkas = [
            'sudah' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])->whereNull('no_test')->count() * 100 / $total_pendaftar,
            'belum' => PendaftaranOnline::whereNull(['path_foto', 'path_rapor', 'path_bayar'])->count() * 100 / $total_pendaftar
        ];
        $verifikasi_berkas = [
            'sudah' => PendaftaranOnline::whereNotNull('no_test')->count() * 100 / $total_pendaftar,
            'belum' => PendaftaranOnline::whereNull('no_test')->count() * 100 / $total_pendaftar
        ];
        $membayar_registrasi = [
            'sudah' => SaveSesi::whereNotNull('sts_upl_buktiregis')->count() * 100 / $total_pendaftar,
            'belum' => SaveSesi::whereNull('sts_upl_buktiregis')->count() * 100 / $total_pendaftar
        ];

        // return [$verifikasi_berkas, $membayar_registrasi];

        return view('pages.dashboard.visual.data_calon_mahasiswa', [
            'unggah_berkas' => $unggah_berkas,
            'verifikasi_berkas' => $verifikasi_berkas,
            'membayar_registrasi' => $membayar_registrasi
        ]);
    }

    public function dataSebaranCalonMahasiswa()
    {
        return view('pages.dashboard.visual.data_sebaran_calon_mahasiswa');
    }
}
