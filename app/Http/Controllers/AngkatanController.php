<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Angkatan;

class AngkatanController extends Controller
{
    public function index (Request $request) {

        $nama_angkatan = $request->nama_angkatan;
        $query = Angkatan::query();
        $query->select('angkatan.*');

        if (!empty($request->nama_angkatan)) {
            $query->where('nama_angkatan', 'like', '%' . $nama_angkatan . '%');
        }
        $angkatan = $query->get();

        // $angkatan = DB::table('angkatan')->orderBy('angkatan_id', 'desc')->get();
        return view('angkatan.index', compact('angkatan'));
    }

    public function store(Request $request) {
        $angkatan_id = $request->angkatan_id;
        $nama_angkatan = $request->nama_angkatan;
        $data = [
            'angkatan_id' => $angkatan_id,
            'nama_angkatan' => $nama_angkatan
        ];

        $simpan = DB::table('angkatan')->insert($data);
        if ($simpan) {
            return Redirect::back()->with('success', 'Data angkatan berhasil disimpan');
        } else {
            return Redirect::back()->with('error', 'Data gagal disimpan');
        }
    }

    public function edit(Request $request) {
        $angkatan_id = $request->angkatan_id;
        $angkatan = DB::table('angkatan')->where('angkatan_id', $angkatan_id)->first();
        return view('angkatan.edit', compact('angkatan'));
    }

    public function update($angkatan_id, Request $request) {
        $nama_angkatan = $request->nama_angkatan;
        $data = [
            'nama_angkatan' => $nama_angkatan
        ];
        $update = DB::table('angkatan')->where('angkatan_id', $angkatan_id)->update($data);
        if ($update) {
            return Redirect::back()->with('success', 'Data berhasil diupdate');
        } else {
            return Redirect::back()->with('error', 'Data gagal diupdate');
        }
    }

    public function delete($angkatan_id) {
        $delete = DB::table('angkatan')->where('angkatan_id', $angkatan_id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'Data berhasil dihapus');
        } else {
            return Redirect::back()->with('error', 'Data gagal dihapus');
        }
    }
}
