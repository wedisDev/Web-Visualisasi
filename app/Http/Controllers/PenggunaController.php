<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use DataTables;

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

    public function createAction(Request $request)
    {
        $this->validate($request, [
            'id_pengguna' => 'required|unique:pengguna,id_pengguna',
            'nama_pengguna' => 'required',
            'email_pengguna' => 'required',
            'jabatan_pengguna' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        Pengguna::create([
            'id_pengguna' => $request->id_pengguna,
            'nama_pengguna' => $request->nama_pengguna,
            'email_pengguna' => $request->email_pengguna,
            'jabatan_pengguna' => $request->jabatan_pengguna,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('pengguna.index');
    }

    public function updateView($id_pengguna)
    {
        $pengguna = Pengguna::where('id_pengguna', '=', $id_pengguna)->first();
        $jabatan = ['warek', 'kabag', 'staf'];

        return view('pages.dashboard.pengguna.update', [
            'pengguna' => $pengguna,
            'jabatan' => $jabatan
        ]);
    }

    public function updateAction(Request $request, $id_pengguna)
    {
        $pengguna = Pengguna::where('id_pengguna', '=', $id_pengguna)->first();

        $this->validate($request, [
            'nama_pengguna' => 'required',
            'email_pengguna' => 'required',
            'username' => 'required'
        ]);

        $pengguna->update([
            'id_pengguna' => $request->id_pengguna,
            'nama_pengguna' => $request->nama_pengguna,
            'email_pengguna' => $request->email_pengguna,
            'jabatan_pengguna' => $request->jabatan_pengguna,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('pengguna.index');
    }

    public function deleteAction($id_pengguna)
    {
        $pengguna = Pengguna::where('id_pengguna', '=', $id_pengguna)->first();
        $pengguna->delete();

        return redirect()->route('pengguna.index');
    }

    public function datatables()
    {
        $model = Pengguna::get();

        return DataTables::of($model)
            ->addIndexColumn()
            ->toJson();
    }
}
