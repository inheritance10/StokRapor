<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrunlerController extends Controller
{
    public function gunSonu(){

        return view('dashboard.gun-sonu');
    }

    public function urunEkle(){

        return view('dashboard.urun-ekle');
    }

    public function urunListele(){

        return view('dashboard.urun-listele');
    }

    public function urunKaydet(Request $request){

        return response($request->all());
    }

    public function satisListele(){

        return view('dashboard.satis-listele');
    }

    public function satisEkle(){

        return view('dashboard.satis-ekle');
    }

    public function satisKaydet(Request $request){

        return response($request->all());
    }

    public function alimListele(){

        return view('dashboard.alim-listele');
    }

    public function alimEkle(){

        return view('dashboard.alim-ekle');
    }

    public function alimKaydet(Request $request){

        return response($request->all());
    }

}
