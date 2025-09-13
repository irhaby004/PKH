<?php

use App\Http\Controllers\AboutController;
use App\Models\Bobot;
use App\Models\Cluster;
use App\Models\Dataset;
use App\Models\Kriteria;
use App\models\Desa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\NamaDesaCalonController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\TrainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|/
*/

Route::middleware('guest')->group(function () {
    Route::get('', function () {
        return view('guest.home');
    })->name('home');
    Route::get('/about', [TrainController::class, 'train'])->name('about');
    Route::get('/about', [TrainController::class, 'importData'])->name('about');
    

    Route::get('/predict', [PredictController::class, 'index'])->name('predict.index');
    Route::post('/predict', [PredictController::class, 'predict'])->name('predict.predict');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        $dataset = Dataset::all()->count();
        $bobot   = Bobot::all()->count();
        $kriteria = Kriteria::all()->count();

        return view('admin.dashboard', compact('dataset',));
    })->name('dashboard');

    Route::resource('dataset', DatasetController::class)->except(['show']);
    Route::resource('bobot', BobotController::class)->except(['show']);
    Route::resource('kriteria', KriteriaController::class)->except(['show']);
    Route::resource('desa', NamaDesaCalonController::class)->except(['show']);
    // dataset
    Route::get('dataset/import', [DatasetController::class, 'import'])->name('dataset.import');
    Route::post('dataset/import', [DatasetController::class, 'store_import'])->name('dataset.store_import');
    Route::post('dataset/reset', [DatasetController::class, 'reset_dataset'])->name('dataset.reset_dataset');
    Route::get('dataset/export_example', [DatasetController::class, 'export_example'])->name('dataset.export_example');
    //Desa
    Route::get('desa/import', [NamaDesaCalonController::class, 'import'])->name('desa.import');
    Route::post('desa/import', [NamaDesaCalonController::class, 'store_import'])->name('desa.store_import');
    Route::post('desa/reset', [NamaDesaCalonController::class, 'reset_dataset'])->name('desa.reset_desa');
    Route::get('dataset/export_example', [NamaDesaCalonController::class, 'export_example'])->name('desa.export_example');
    // bobot
    Route::get('bobot/import', [BobotController::class, 'import'])->name('bobot.import');
    Route::post('bobot/import', [BobotController::class, 'store_import'])->name('bobot.store_import');
    Route::post('bobot/reset', [BobotController::class, 'reset_dataset'])->name('bobot.reset_bobot');
    Route::get('bobot/export_example', [BobotController::class, 'export_example'])->name('bobot.export_example');
    // kriteria
    Route::get('kriteria/import', [KriteriaController::class, 'import'])->name('kriteria.import');
    Route::post('kriteria/import', [KriteriaController::class, 'store_import'])->name('kriteria.store_import');
    Route::post('kriteria/reset', [KriteriaController::class, 'reset_dataset'])->name('kriteria.reset_kriteria');
    Route::get('kriteria/export_example', [KriteriaController::class, 'export_example'])->name('kriteria.export_example');
});

require __DIR__ . '/auth.php';
