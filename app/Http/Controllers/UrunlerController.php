<?php

namespace App\Http\Controllers;

use App\Models\alinanlar;
use App\Models\harcamalar;
use App\Models\malzemeler;
use App\Models\recete_malzemeler;
use App\Models\satislar;
use App\Models\urunler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrunlerController extends Controller
{
    public function anasayfa()
    {
        $satislarAll = satislar::all();
        $toplamSatis = 0;
        $toplamAlis = alinanlar::sum('toplam_fiyat');
        $kayipGram = harcamalar::leftJoin('malzemeler', 'malzeme_id', 'malzemeler.id')
            ->where('miktar_tipi', 'gram')
            ->where('harcama_turu', 'kayip')
            ->sum('harcama_miktari');
        $kayipAdet =harcamalar::leftJoin('malzemeler', 'malzeme_id', 'malzemeler.id')
            ->where('miktar_tipi', 'adet')
            ->where('harcama_turu', 'kayip')
            ->sum('harcama_miktari');
        foreach ($satislarAll as $satis) {
            $urun = urunler::find($satis->id);
            $toplamSatis += $urun->satis_fiyati * $satis->satis_miktari;
        }

        return view('dashboard.dashboard', compact('toplamSatis', 'toplamAlis', 'kayipAdet', 'kayipGram'));
    }

    public function gunSonu()
    {

        return view('dashboard.gun-sonu');
    }

    public function malzemeEkle()
    {

        return view('dashboard.malzeme-ekle');
    }

    public function malzemeleriGetir($id)
    {
        $malzemeler = recete_malzemeler::leftJoin('malzemeler', 'malzemeler_id', 'malzemeler.id')
            ->where('recete_id', $id)
            ->get()
            ->pluck('recete_malzeme_miktar', 'malzeme_adi');
        return response()->json($malzemeler);
    }

    public function malzemeKaydet(Request $request)
    {
        $malzemeler = $request->malzeme;
        $miktar_tipleri = $request->miktar_tipi;
        for ($i = 0; $i < count($malzemeler); $i++) {
            if (empty($malzemeler[$i]) || empty($miktar_tipleri[$i]))
                continue;
            malzemeler::create([
                'malzeme_adi' => $malzemeler[$i],
                'miktar_tipi' => $miktar_tipleri[$i]
            ]);
        }
        return redirect('urun-listele');
    }

    public function urunEkle()
    {
        $malzemeler = malzemeler::all();
        return view('dashboard.urun-ekle', compact('malzemeler'));
    }

    public function urunListele()
    {
        $urunler = urunler::select('urun_adi',
            'id',
            'satis_fiyati',
            DB::raw('(SELECT COUNT(id) FROM recete_malzemeler WHERE recete_id = urunler.id) as adet'))
            ->get();
        return view('dashboard.urun-listele', compact('urunler'));
    }

    public function urunKaydet(Request $request)
    {

        $urun = urunler::create([
            'urun_adi' => $request->urun_adi
        ]);
        $malzemeler = $request->malzeme;
        $miktarlar = $request->malzeme_miktar;

        for ($i = 0; $i < count($malzemeler); $i++) {
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

    public function satisListele()
    {
        $satislarAll = satislar::whereDate('created_at', '>=', Carbon::now()->startOfMonth())
            ->get();

        $satislar = [];
        for ($i = 0; $i < count($satislarAll); $i++) {
            $id = $satislarAll[$i]->id;
            $urun = urunler::find($id);
            $satislar[$i]["urun_adi"] = $urun->urun_adi;
            $satislar[$i]["toplam_satis"] = $satislarAll[$i]->satis_miktari;
            $satislar[$i]["toplam_gelir"] = $urun->satis_fiyati * $satislarAll[$i]->satis_miktari;
            $satislar[$i]["adet_fiyati"] = $urun->satis_fiyati;
        }

        return view('dashboard.satis-listele', compact('satislar'));
    }

    public function satisEkle()
    {
        $urunler = urunler::all();

        return view('dashboard.satis-ekle', compact('urunler'));
    }

    public function satisKaydet(Request $request)
    {
        $urunler = $request->urun;
        $miktarlar = $request->urun_adet;
        $fiyatlar = $request->adet_fiyat;

        for ($i = 0; $i < count($urunler); $i++) {
            if (empty($urunler[$i]) || empty($miktarlar[$i]))
                continue;
            satislar::create([
                'malzeme_id' => $urunler[$i],
                'alinan_miktar' => $miktarlar[$i],
                'toplam_fiyat' => $fiyatlar[$i]
            ]);
        }

        return redirect()->route('satis-listele');
    }

    public function alimListele()
    {
        $alimlar = alinanlar::leftJoin('malzemeler', 'malzeme_id', 'malzemeler.id')
            ->get();

        return view('dashboard.alim-listele', compact('alimlar'));
    }

    public function alimEkle()
    {

        $malzemeler = malzemeler::all();

        return view('dashboard.alim-ekle', compact('malzemeler'));
    }

    public function alimKaydet(Request $request)
    {
        $malzemeler = $request->malzeme;
        $miktarlar = $request->malzeme_miktar;
        $fiyatlar = $request->toplam_fiyat;

        for ($i = 0; $i < count($malzemeler); $i++) {
            if (empty($malzemeler[$i]) || empty($miktarlar[$i]))
                continue;
            alinanlar::create([
                'malzeme_id' => $malzemeler[$i],
                'alinan_miktar' => $miktarlar[$i],
                'toplam_fiyat' => $fiyatlar[$i]
            ]);
        }

        return redirect()->route('alim-listele');
    }

}
