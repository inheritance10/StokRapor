<?php

namespace App\Http\Controllers;

use App\Models\malzemeler;
use App\Models\recete_malzemeler;
use App\Models\urunler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrunlerController extends Controller
{
    public function anasayfa(){

        return view('dashboard.dashboard');
    }

    public function gunSonu(){

        return view('dashboard.gun-sonu');
    }

    public function malzemeEkle(){

        return view('dashboard.malzeme-ekle');
    }

    public function malzemeleriGetir($id){
        $malzemeler = recete_malzemeler::leftJoin('malzemeler', 'malzemeler_id', 'malzemeler.id')->where('recete_id', $id)->get()->pluck('recete_malzeme_miktar', 'malzeme_adi');
        return response()->json($malzemeler);
    }

    public function malzemeKaydet(Request $request){
        $malzemeler = $request->malzeme;
        $miktar_tipleri = $request->miktar_tipi;
        for ($i=0; $i< count($malzemeler); $i++) {
            if (empty($malzemeler[$i]) || empty($miktar_tipleri[$i]))
                continue;
            malzemeler::create([
                'malzeme_adi' => $malzemeler[$i],
                'miktar_tipi' => $miktar_tipleri[$i]
            ]);
        }


        return redirect('urun-listele');
    }

    public function urunEkle(){
        $malzemeler = malzemeler::all();
        return view('dashboard.urun-ekle', compact('malzemeler'));
    }

    public function urunListele(){
        $urunler = urunler::select('urun_adi',
            'id',
            'satis_fiyati',
            DB::raw('(SELECT COUNT(id) FROM recete_malzemeler WHERE recete_id = urunler.id) as adet'))
            ->get();
        return view('dashboard.urun-listele', compact('urunler'));
    }

    public function urunKaydet(Request $request){

        $urun = urunler::create([
            'urun_adi' => $request->urun_adi
        ]);
        $malzemeler = $request->malzeme;
        $miktarlar = $request->malzeme_miktar;

        for ($i=0; $i< count($malzemeler); $i++) {
            if (empty($malzemeler[$i]) || empty($miktarlar[$i]))
                continue;
            recete_malzemeler::create([
                'recete_id' => $urun->id,
                'malzemeler_id' => $malzemeler[$i],
                'recete_malzeme_miktar' => $miktarlar[$i]
            ]);
        }



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
