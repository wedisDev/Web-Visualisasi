<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisualController extends Controller
{
    public function dataCalonMahasiswa()
    {
        return view('pages.dashboard.visual.data_calon_mahasiswa');
    }

    public function dataSebaranCalonMahasiswa()
    {
        return view('pages.dashboard.visual.data_sebaran_calon_mahasiswa');
    }
}
