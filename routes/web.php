<?php

use App\Http\Controllers\UrunlerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    Route::get('urun-listele', [UrunlerController::class, 'urunListele']);
    Route::get('urun-ekle', [UrunlerController::class, 'urunEkle']);
    Route::post('urun-kaydet', [UrunlerController::class, 'urunKaydet']);

    Route::get('satis-listele', [UrunlerController::class, 'satisListele']);
    Route::get('satis-ekle', [UrunlerController::class, 'satisEkle']);
    Route::get('satis-kaydet', [UrunlerController::class, 'satisKaydet']);

    Route::get('alim-listele', [UrunlerController::class, 'alimListele']);
    Route::get('alim-ekle', [UrunlerController::class, 'alimEkle']);
    Route::get('alim-kaydet', [UrunlerController::class, 'alimKaydet']);

    Route::get('gun-sonu', [UrunlerController::class, 'gunSonu']);

});
require __DIR__.'/auth.php';
