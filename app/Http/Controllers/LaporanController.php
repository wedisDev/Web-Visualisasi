<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranOnline;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $seluruh_tahun = PendaftaranOnline::whereNotNull('no_test')
            ->select(DB::raw("SUBSTR(no_test, 0, 2) as tahun"))
            ->orderBy('tahun', 'ASC')->distinct()->get();

        return view('pages.dashboard.laporan.index', [
            'tahun' => [
                'pertama' => '20' . $seluruh_tahun[0]['tahun'],
                'akhir' => '20' . $seluruh_tahun[count($seluruh_tahun) - 1]['tahun']
            ]
        ]);
    }

    public function laporanGeneratePDF(Request $request)
    {
        $unggah_berkas = [
            'sudah' => PendaftaranOnline::whereNotNull(['path_foto', 'path_rapor', 'path_bayar'])->whereNull('no_test')->get(),
            'belum' => PendaftaranOnline::whereNull(['path_foto', 'path_rapor', 'path_bayar'])->get()
        ];
        // return $unggah_berkas;

        $pdf = Pdf::loadView('laporan.pdf', [
            'title' => date_format(Carbon::now(), 'dmy'),
            'unggah_berkas' => $unggah_berkas
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
