<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function laporanGeneratePDF()
    {
        $pdf = Pdf::loadView('laporan.pdf');

        return $pdf->stream();
    }
}
