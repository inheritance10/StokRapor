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
    Route::get('/dashboard', [UrunlerController::class, 'anasayfa']);

    Route::get('recete-listele', [UrunlerController::class, 'urunListele'])->name('urun-listele');
    Route::get('urun-ekle', [UrunlerController::class, 'urunEkle'])->name('urun-ekle');
    Route::get('urun-duzenle', [UrunlerController::class, 'urunDuzenle'])->name('urun-duzenle');
    Route::post('urun-duzenle-kaydet', [UrunlerController::class, 'urunDuzenleKaydet'])->name('urun-duzenle-kaydet');
    Route::post('urun-kaydet', [UrunlerController::class, 'urunKaydet'])->name('urun-kaydet');
    Route::post('recete-sil/{id}', [UrunlerController::class, 'receteSil'])->name('recete-sil');

    Route::get('malzeme-ekle', [UrunlerController::class, 'malzemeEkle'])->name('malzeme-ekle');
    Route::get('malzemeleri-getir/{id}', [UrunlerController::class, 'malzemeleriGetir'])->name('malzemeleri-getir');
    Route::post('malzeme-kaydet', [UrunlerController::class, 'malzemeKaydet'])->name('malzeme-kaydet');
    Route::get('malzeme-duzenle', [UrunlerController::class, 'malzemeDuzenle'])->name('malzeme-duzenle');
    Route::post('malzeme-duzenle-kaydet', [UrunlerController::class, 'malzemeDuzenleKaydet'])->name('malzeme-duzenle-kaydet');
    Route::get('malzeme-detay', [UrunlerController::class, 'malzemeDetay'])->name('malzeme-detay');
    Route::post('urun-sil/{malzeme}', [UrunlerController::class, 'malzemeSil'])->name('malzeme-sil');

    Route::get('satis-listele', [UrunlerController::class, 'satisListele'])->name('satis-listele');
    Route::get('satis-ekle', [UrunlerController::class, 'satisEkle'])->name('satis-ekle');
    Route::post('satis-kaydet', [UrunlerController::class, 'satisKaydet'])->name('satis-kaydet');

    Route::get('kayip-ekle', [UrunlerController::class, 'kayipEkle'])->name('kayip-ekle');
    Route::post('kayip-kaydet', [UrunlerController::class, 'kayipKaydet'])->name('kayip-kaydet');
    Route::get('alim-listele', [UrunlerController::class, 'alimListele'])->name('alim-listele');
    Route::get('alim-ekle', [UrunlerController::class, 'alimEkle'])->name('alim-ekle');
    Route::post('alim-kaydet', [UrunlerController::class, 'alimKaydet'])->name('alim-kaydet');

    Route::get('stok-listele', [UrunlerController::class, 'stokListele'])->name('stok-listele');
    Route::get('son-silineni-getir', [UrunlerController::class, 'sonSilineniGeriAl'])->name('son-silineni-getir');

});
require __DIR__.'/auth.php';
