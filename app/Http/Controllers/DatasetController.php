<?php

namespace App\Http\Controllers;

use App\Exports\DatasetsExportExample;
use App\Imports\DatasetsImport;
use App\Models\Dataset;
use App\Models\Dataset_Detail;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DatasetController extends Controller
{
    public function index()
    {
        $datasets = Dataset::all();
        $kriteria = Kriteria::all();
        return view('admin.dataset.dataset', compact('datasets', 'kriteria'));
    }

    public function create()
    {
        $kriteria = Kriteria::all();
        return view('admin.dataset.add', compact('kriteria'));
    }

    public function store(Request $request)
{
    \Log::info('Masuk method store Dataset');

    // Ambil data kriteria
    $kriteria = Kriteria::all();

    // Aturan validasi
    $validationRules = [
        'nama' => 'required|string|max:255',
    ];

    foreach ($kriteria as $k) {
        $validationRules['kriteria_' . $k->id] = [
            'required',
            'numeric',
            'min:' . $k->min,
            'max:' . $k->max,
        ];
    }

    $messages = [
        'required' => 'Harap isi terlebih dahulu.',
        'numeric' => 'Harap masukkan angka yang valid.',
        'min' => 'Nilai harus lebih besar atau sama dengan :min.',
        'max' => 'Nilai harus lebih kecil atau sama dengan :max.',
    ];

    // Validasi input user
    $data = $request->validate($validationRules, $messages);

    try {
        // Simpan data dataset utama
        $dataset = Dataset::create([
            'nama' => $data['nama'],
        ]);

        // Simpan detail setiap kriteria
        foreach ($kriteria as $k) {
            $statusKey = 'kriteria_' . $k->id;
            Dataset_Detail::create([
                'id_dataset' => $dataset->id,
                'id_kriteria' => $k->id,
                'status' => $data[$statusKey],
            ]);
        }

        return redirect()->route('dataset.index')->with('message', [
            'success' => true,
            'message' => 'Dataset berhasil ditambahkan.',
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('message', [
            'success' => false,
            'message' => 'Gagal menyimpan dataset: ' . $e->getMessage(),
        ]);
    }
}

public function edit($id)
{
    // Ambil dataset berdasarkan ID
    $dataset = Dataset::with('details.kriteria')->findOrFail($id);

    // Ambil semua kriteria
    $allKriteria = Kriteria::all();

    // Cek kriteria baru yang belum ada di dataset
    $existingKriteriaIds = $dataset->details->pluck('id_kriteria')->toArray();
    $newKriteria = $allKriteria->filter(function ($kriteria) use ($existingKriteriaIds) {
        return !in_array($kriteria->id, $existingKriteriaIds);
    });

    // Tambahkan kriteria baru dengan nilai default 0
    foreach ($newKriteria as $kriteria) {
        $dataset->details->push((object)[
            'id_kriteria' => $kriteria->id,
            'kriteria' => $kriteria,
            'status' => 0, // Nilai default
        ]);
    }

    // Kirim dataset dan kriteria ke tampilan
    return view('admin.dataset.edit', compact('dataset'));
}


public function update(Request $request, $id)
{
    $dataset = Dataset::findOrFail($id);
    $kriteria = Kriteria::all();

    // Aturan validasi
    $validationRules = [
        'nama' => 'required|string|max:255',
    ];

    foreach ($kriteria as $k) {
        $validationRules['kriteria_' . $k->id] = [
            'required',
            'numeric',
            'min:' . $k->min,
            'max:' . $k->max,
        ];
    }

    $messages = [
        'required' => 'Harap isi terlebih dahulu.',
        'numeric' => 'Harap masukkan angka yang valid.',
        'min' => 'Nilai harus lebih besar atau sama dengan :min.',
        'max' => 'Nilai harus lebih kecil atau sama dengan :max.',
    ];

    // Validasi input user
    $data = $request->validate($validationRules, $messages);

    try {
        // Update dataset utama
        $dataset->update([
            'nama' => $data['nama'],
        ]);

        // Update detail setiap kriteria
        foreach ($kriteria as $k) {
            $statusKey = 'kriteria_' . $k->id;
            Dataset_Detail::updateOrCreate(
                ['id_dataset' => $dataset->id, 'id_kriteria' => $k->id],
                ['status' => $data[$statusKey]]
            );
        }

        return redirect()->route('dataset.index')->with('message', [
            'success' => true,
            'message' => 'Dataset berhasil diperbarui.',
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('message', [
            'success' => false,
            'message' => 'Gagal memperbarui dataset: ' . $e->getMessage(),
        ]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataset = Dataset::findOrFail($id);
        $success = $dataset->delete();
        return redirect(route('dataset.index'))->with('message', [
            'success' => $success ? TRUE : FALSE,
            'message' => 'Dataset ' . ($success ? 'berhasil' : 'gagal') . ' dihapus'
        ]);
    }

    public function import()
    {
        return view('admin.dataset.import');
    }

    public function store_import(Request $request)
    {
        $data = $request->validate([
            'file'   => 'required|mimes:xlsx,xls',
        ], [
            'file.required' => 'Tahun belum diisi',
            'file.mimes'    => 'Ekstensi file harus berupa xlsx atau xls',
        ]);

        Excel::import(new DatasetsImport, request()->file('file'));

        $success = TRUE;

        return redirect(route('dataset.index'))->with('message', [
            'success' => $success ? TRUE : FALSE,
            'message' => 'Dataset ' . ($success ? 'berhasil' : 'gagal') . ' diimport'
        ]);
    }

    public function reset_dataset()
    {
        DB::table('datasets')->truncate();
        $success = TRUE;
        return redirect(route('dataset.index'))->with('message', [
            'success' => $success ? TRUE : FALSE,
            'message' => 'Dataset ' . ($success ? 'berhasil' : 'gagal') . ' direset'
        ]);
    }
}
