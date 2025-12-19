<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use Yajra\DataTables\Services\DataTables;
use App\Http\Controllers\ImmutableLedgerController;
use App\Http\Controllers\AssetController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/ledger/', [ImmutableLedgerController::class, 'index'])->name('ledger.index');
Route::get('/ledger/audio-fp', [ImmutableLedgerController::class, 'audioFingerprint2'])->name('ledger.audio-fp');
Route::post('/ledger/audio-fp/process', [ImmutableLedgerController::class, 'processAudioFingerprint'])->name('audio-fp.process');
Route::get('/ledger/search', [ImmutableLedgerController::class, 'search'])->name('ledger.search');
Route::get('/ledger/{hash}', [ImmutableLedgerController::class, 'show'])->name('ledger.show');
Route::get('/asset/{id}', [AssetController::class, 'show'])->name('asset.show');
Route::get('/asset/audio-fingerprint', [AssetController::class, 'audioFingerprint'])->name('asset.audio-fingerprint');





require __DIR__ . '/auth.php';
