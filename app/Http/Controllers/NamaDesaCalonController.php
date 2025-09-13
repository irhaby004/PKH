<?php

namespace App\Http\Controllers;

use App\Models\desa;
use App\Models\NamaDesaCalon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class NamaDesaCalonController extends Controller
{
  public function index()
  {

    $nama_desa_calons = NamaDesaCalon::all();
    return view('admin.desa.desa', compact('nama_desa_calons'));
  }

  public function create()
  {
    return view('admin.desa.adddesa');
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'nama_desa_calon'           => 'required',
    ], [
      'nama_desa_calon.required'  => 'Harap Isi Terlebih Dahulu',
    ]);


    $success = NamaDesaCalon::create($data);

    return redirect(route('desa.index'))->with('message', [
      'success' => $success ? TRUE : FALSE,
      'message' => 'bobot ' . ($success ? 'berhasil' : 'gagal') . ' ditambahkan'
    ]);
  }

  public function edit($id)
  {
    $nama_desa_calon = NamaDesaCalon::findOrFail($id);
    return view('admin.desa.editdesa', compact('nama_desa_calon'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $desa = NamaDesaCalon::findOrFail($id);

    $data = $request->validate([
      'nama_desa_calon'             => 'required',
    ], [
      'nama_desa_calon.required'    => 'Harap Isi Terlebih Dahulu',
    ]);


    $success = $desa->update($data);

    return redirect(route('desa.index'))->with('message', [
      'success' => $success ? TRUE : FALSE,
      'message' => 'desa ' . ($success ? 'berhasil' : 'gagal') . ' diupdate'
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $desa = NamaDesaCalon::findOrFail($id);
    $success = $desa->delete();
    return redirect(route('desa.index'))->with('message', [
      'success' => $success ? TRUE : FALSE,
      'message' => 'Nama Desa ' . ($success ? 'berhasil' : 'gagal') . ' dihapus'
    ]);
  }

  public function reset_bobot()
  {
    DB::table('nama_desa_calon')->truncate();
    $success = TRUE;
    return redirect(route('desa.index'))->with('message', [
      'success' => $success ? TRUE : FALSE,
      'message' => 'Nama Desa ' . ($success ? 'berhasil' : 'gagal') . ' direset'
    ]);
  }
}
