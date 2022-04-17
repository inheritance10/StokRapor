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

    Route::get('/', [UrunlerController::class, 'anasayfa'])->name('dashboard');

    Route::get('urun-listele', [UrunlerController::class, 'urunListele'])->name('urun-listele');;
    Route::get('urun-ekle', [UrunlerController::class, 'urunEkle'])->name('urun-ekle');;
    Route::post('urun-kaydet', [UrunlerController::class, 'urunKaydet'])->name('urun-kaydet');

    Route::get('malzeme-ekle', [UrunlerController::class, 'malzemeEkle'])->name('malzeme-ekle');;
    Route::get('malzemeleri-getir/{id}', [UrunlerController::class, 'malzemeleriGetir'])->name('malzemeleri-getir');;
    Route::post('malzeme-kaydet', [UrunlerController::class, 'malzemeKaydet'])->name('malzeme-kaydet');;
    Route::get('malzeme-detay', [UrunlerController::class, 'malzemeDetay'])->name('malzeme-detay');;

    Route::get('satis-listele', [UrunlerController::class, 'satisListele'])->name('satis-listele');;
    Route::get('satis-ekle', [UrunlerController::class, 'satisEkle'])->name('satis-ekle');;
    Route::post('satis-kaydet', [UrunlerController::class, 'satisKaydet'])->name('satis-kaydet');;

    Route::get('alim-listele', [UrunlerController::class, 'alimListele'])->name('alim-listele');;
    Route::get('alim-ekle', [UrunlerController::class, 'alimEkle'])->name('alim-ekle');;
    Route::post('alim-kaydet', [UrunlerController::class, 'alimKaydet'])->name('alim-kaydet');;

    Route::get('gun-sonu', [UrunlerController::class, 'gunSonu'])->name('gun-sonu');;

});
require __DIR__.'/auth.php';
