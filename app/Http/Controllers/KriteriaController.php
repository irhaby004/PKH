<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
  public function index()
  {

    $kriterias = Kriteria::all();
    return view('admin.kriteria.kriteria', compact('kriterias'));
  }

  public function create()
  {
    return view('admin.kriteria.addkriteria');
  }

  public function store(Request $request)
  {
    $data = $request->validate([
        'nama_kriteria' => 'required',
        'peringkat'     => 'required|integer',
        'min' => 'required|integer',
        'max' => 'required|integer|gte:min',
    ], [
        'peringkat.required'      => 'Harap Isi Terlebih Dahulu',
        'nama_kriteria.required'  => 'Harap Isi Terlebih Dahulu',
        'max.gte' => 'Nilai maksimal harus lebih besar atau sama dengan nilai minimal.',
    ]);

    // Cek jika nama_kriteria adalah 'Umur' dan nilainya lebih dari 60
    if ($data['nama_kriteria'] === 'Umur' && (int)$data['peringkat'] > 60) {
        $data['nama_kriteria'] = 'Lansia';
    }

    $success = Kriteria::create($data);

    return redirect(route('kriteria.index'))->with('message', [
        'success' => $success ? TRUE : FALSE,
        'message' => 'bobot ' . ($success ? 'berhasil' : 'gagal') . ' ditambahkan'
    ]);
  }


  public function edit($id)
  {
    $kriteria = Kriteria::findOrFail($id);
    return view('admin.kriteria.editkriteria', compact('kriteria'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $kriteria = Kriteria::findOrFail($id);

    $data = $request->validate([
        'nama_kriteria' => 'required',
        'peringkat'     => 'required|integer',
        'min' => 'required|integer',
        'max' => 'required|integer|gte:min',
    ], [
        'peringkat.required'      => 'Harap Isi Terlebih Dahulu',
        'nama_kriteria.required'  => 'Harap Isi Terlebih Dahulu',
        'max.gte' => 'Nilai maksimal harus lebih besar atau sama dengan nilai minimal.',
    ]);

    // Cek jika nama_kriteria adalah 'Umur' dan nilainya lebih dari 60
    if ($data['nama_kriteria'] === 'Umur' && (int)$data['peringkat'] > 60) {
        $data['nama_kriteria'] = 'Lansia';
    }

    $success = $kriteria->update($data);

    return redirect(route('kriteria.index'))->with('message', [
        'success' => $success ? TRUE : FALSE,
        'message' => 'kriteria ' . ($success ? 'berhasil' : 'gagal') . ' diupdate'
    ]);
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $kriteria = Kriteria::findOrFail($id);
    $success = $kriteria->delete();
    return redirect(route('kriteria.index'))->with('message', [
      'success' => $success ? TRUE : FALSE,
      'message' => 'bobot ' . ($success ? 'berhasil' : 'gagal') . ' dihapus'
    ]);
  }

  public function reset_bobot()
  {
    DB::table('kriteria')->truncate();
    $success = TRUE;
    return redirect(route('kriteria.index'))->with('message', [
      'success' => $success ? TRUE : FALSE,
      'message' => 'bobot ' . ($success ? 'berhasil' : 'gagal') . ' direset'
    ]);
  }
}
