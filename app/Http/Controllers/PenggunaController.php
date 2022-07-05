<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.pengguna.index');
    }

    public function createView()
    {
        return view('pages.dashboard.pengguna.create');
    }

    public function updateView()
    {
        return view('pages.dashboard.pengguna.update');
    }
}
