<?php

namespace App\Http\Controllers;

use App\Models\alinanlar;
use App\Models\harcamalar;
use App\Models\malzemeler;
use App\Models\recete_malzemeler;
use App\Models\receteler;
use App\Models\satislar;
use App\Models\urunler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrunlerController extends Controller
{
    public function anasayfa()
    {
        $toplamSatis = satislar::count();
        $toplamAlis = alinanlar::sum('toplam_fiyat');
        $kayipMiktar = harcamalar::leftJoin('malzemeler', 'malzeme_id', 'malzemeler.id')
            ->where('harcama_turu', 'kayip')
            ->sum('harcama_miktari');

        return view('dashboard.dashboard', compact('toplamSatis', 'toplamAlis', 'kayipMiktar'));
    }

    public function stokListele()
    {
        $malzemeler = DB::select('select id, malzeme_adi, miktar_tipi, (select sum(stok_miktar)  from alinanlar where alinanlar.malzeme_id = m.id ) as miktar from malzemeler m where m.deleted_at is null order by malzeme_adi');
        $malzemeGiderler = DB::select('select malzeme_adi, miktar_tipi, (select sum(toplam_fiyat) from alinanlar where alinanlar.malzeme_id = m.id and month(now()) = month(created_at) and year(now()) = year(created_at)) as fiyat from malzemeler m');
        return view('dashboard.stok-listele', compact('malzemeler', 'malzemeGiderler'));
    }

    public function malzemeEkle()
    {
        return view('dashboard.malzeme-ekle');
    }

    public function malzemeleriGetir($id)
    {
        $malzemeler = recete_malzemeler::leftJoin('malzemeler', 'malzemeler_id', 'malzemeler.id')
            ->where('recete_id', $id)
            ->get();
        $donus = "";
        foreach ($malzemeler as $malzeme) {
            $donus .= $donus == "" ? "" : ", ";
            $donus .= $malzeme->malzeme_adi . ": " . $malzeme->recete_malzeme_miktar . " " . $malzeme->miktar_tipi;
        }
        return response()->json($donus);
    }

    public function malzemeKaydet(Request $request)
    {
        $malzemeler = $request->malzeme;
        $miktar_tipleri = $request->miktar_tipi;
        for ($i = 0; $i < count($malzemeler); $i++) {
            if (empty($malzemeler[$i]) || empty($miktar_tipleri[$i]))
                return back()->with('status', 'Yeterli Ürün Yok.');
            try {
                malzemeler::create([
                    'malzeme_adi' => tr_strtoupper($malzemeler[$i]),
                    'miktar_tipi' => $miktar_tipleri[$i]
                ]);
            } catch (\Exception $exception) {
                return back()->with('status', 'Girdiğiniz' . $malzemeler[$i] . ' ürünü sistemde mevcut.');
            }

        }
        return redirect()->route('urun-listele');
    }

    public function malzemeDuzenle(Request $request)
    {
        $malzeme = malzemeler::withTrashed()->find($request->id);
        return view('dashboard.malzeme-duzenle', compact('malzeme'));
    }

    public function malzemeDuzenleKaydet(Request $request)
    {
        $malzeme = malzemeler::withTrashed()->find($request->id);
        try {
            $malzeme->update([
                'malzeme_adi' => tr_strtoupper($request->malzeme_adi),
                'miktar_tipi' => $request->miktar_tipi
            ]);
        } catch (\Exception $exception) {
            return back()->with('status', 'Girdiğiniz ürün sistemde mevcut.');
        }
        return redirect()->route('urun-listele');
    }

    public function urunEkle()
    {
        $malzemeler = malzemeler::all();
        return view('dashboard.urun-ekle', compact('malzemeler'));
    }

    public function receteSil($id)
    {
        urunler::find($id)?->delete();
        recete_malzemeler::where('recete_id', $id)->delete();
        return redirect()->route('urun-listele')->with('status', 'Reçete başarıyla silindi.');
    }

    public function urunListele()
    {
        $urunler = urunler::select('urun_adi',
            'id',
            DB::raw('(SELECT COUNT(id) FROM recete_malzemeler WHERE recete_id = urunler.id) as adet'))
            ->get();

        foreach ($urunler as $urun) {
            $urun->toplam = 0;
            $malzemeler = recete_malzemeler::where('recete_id', $urun->id)
                ->get();
            foreach ($malzemeler as $malzeme) {
                $alinan = alinanlar::where('malzeme_id', $malzeme->malzemeler_id)->orderBy('created_at', 'desc')->first();
                if (isset($alinan)) {
                    $birimFiyat = $alinan->toplam_fiyat / $alinan->alinan_miktar;
                    $urun->toplam += $malzeme->recete_malzeme_miktar * $birimFiyat;
                }
            }
        }
        return view('dashboard.urun-listele', compact('urunler'));
    }

    public function urunKaydet(Request $request)
    {
        if (empty($request->urun_adi))
            return back()->with('status', 'Lütfen Geçerli Değerler Giriniz.');

        try {
            $urun = urunler::create([
                'urun_adi' => tr_strtoupper($request->urun_adi)
            ]);
        } catch (\Exception $e) {
            return back()->with('status', 'Girdiğiniz reçete sistemde mevcut.');
        }
        $malzemeler = $request->malzeme;
        $miktarlar = $request->malzeme_miktar;

        for ($i = 0; $i < count($malzemeler); $i++) {
            if (empty($malzemeler[$i]) || empty($miktarlar[$i]) || $miktarlar[$i] <= 0)
                return back()->with('status', 'Lütfen Geçerli Değerler Giriniz.');
            recete_malzemeler::create([
                'recete_id' => $urun->id,
                'malzemeler_id' => $malzemeler[$i],
                'recete_malzeme_miktar' => $miktarlar[$i]
            ]);


        }
        return redirect()->route('urun-listele');
    }

    public function urunDuzenle(Request $request)
    {
        $urun = urunler::where('urunler.id', $request->id)->first();
        $recete_malzemeler = recete_malzemeler::where('recete_id', $request->id)->get();
        $malzemeler = malzemeler::withTrashed()->get();
        return view('dashboard.urun-duzenle', compact('malzemeler', 'urun', 'recete_malzemeler'));
    }

    public function urunDuzenleKaydet(Request $request)
    {

        $urun = urunler::find($request->id);
        try {
            $urun->update([
                'urun_adi' => tr_strtoupper($request->urun_adi)
            ]);
        } catch (\Exception $e) {
            return back()->with('status', 'Girdiğiniz reçete sistemde mevcut.');
        }
        DB::beginTransaction();
        recete_malzemeler::where('recete_id', $request->id)->delete();
        $malzemeler = $request->malzeme;
        $miktarlar = $request->malzeme_miktar;

        for ($i = 0; $i < count($malzemeler); $i++) {
            if (empty($malzemeler[$i]) || empty($miktarlar[$i]) || $miktarlar[$i] <= 0) {
                DB::rollBack();
                return back()->with('status', 'Lütfen Geçerli Değerler Giriniz.');
            }
            recete_malzemeler::create([
                'recete_id' => $urun->id,
                'malzemeler_id' => $malzemeler[$i],
                'recete_malzeme_miktar' => $miktarlar[$i]
            ]);
        }
        DB::commit();
        return redirect()->route('urun-listele');
    }

    public function malzemeSil(malzemeler $malzeme)
    {
        $malzeme->delete();
        return redirect()->route('stok-listele')->with('status', 'Ürün başarıyla silindi.');
    }

    public function satisListele()
    {
        $satislarAll = satislar::whereDate('created_at', '>=', Carbon::now()->startOfMonth())
            ->orderBy('created_at', 'desc')
            ->get();

        $satislar = [];
        for ($i = 0; $i < count($satislarAll); $i++) {
            $id = $satislarAll[$i]->urun_id;
            $urun = urunler::withTrashed()->find($id);
            $satislar[$i]["urun_adi"] = $urun->urun_adi;
            $satislar[$i]["toplam_satis"] = $satislarAll[$i]->satis_miktari;
            $satislar[$i]["created_at"] = $satislarAll[$i]->created_at;
            /*            $satislar[$i]["toplam_gider"] = $urun->satis_fiyati * $satislarAll[$i]->satis_miktari;
                        $satislar[$i]["adet_fiyati"] = $urun->satis_fiyati;*/
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

        DB::beginTransaction();
        $urunler = $request->urun;
        $miktarlar = $request->urun_adet;
        $tukenenUrunler = "";
        for ($i = 0; $i < count($urunler); $i++) {
            if (empty($urunler[$i]) || empty($miktarlar[$i]) || $miktarlar[$i] <= 0) {
                DB::rollBack();
                return back()->with('status', 'Lütfen Geçerli Değerler Giriniz.');
            }
            $malzemeler = recete_malzemeler::where('recete_id', $urunler[$i])->get();
            for ($k = 0; $k < $miktarlar[$i]; $k++) {
                for ($j = 0; $j < count($malzemeler); $j++) {
                    $alinan = alinanlar::where('malzeme_id', $malzemeler[$j]->malzemeler_id)
                        ->where('stok_miktar', '>', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
                    $alinanToplam = alinanlar::where('malzeme_id', $malzemeler[$j]->malzemeler_id)
                        ->where('stok_miktar', '>', 0)
                        ->orderBy('created_at', 'desc')
                        ->sum('stok_miktar');
                    if (count($alinan) <= 0) {
                        DB::rollBack();
                        return back()->with('status', 'Yeterli Ürün Yok.');
                    }
                    $alinanKalan = $alinanToplam - ($malzemeler[$j]->recete_malzeme_miktar * $miktarlar[$i]);
                    $harcanacak = $malzemeler[$j]->recete_malzeme_miktar;

                    //Alinanlar da yeterli stok varmı kontrolü yapılıyor
                    if ($alinanKalan >= 0) {
                        foreach ($alinan as $al) {
                            if ($harcanacak >= $al->stok_miktar) {
                                $harcanacak = $harcanacak - $al->stok_miktar;
                                $al->stok_miktar = 0;
                            } else {
                                $al->stok_miktar = $al->stok_miktar - $harcanacak;
                            }
                            $al->save();
                            $malzeme = malzemeler::find($malzemeler[$j]->malzemeler_id)->malzeme_adi;
                            if ($alinanKalan == 0 && !str_contains($tukenenUrunler, $malzeme)) {
                                $tukenenUrunler .= $tukenenUrunler == "" ? "" : " ,";
                                $tukenenUrunler .= $malzeme;
                            }
                        }
                    } else {
                        DB::rollBack();
                        return back()->with('status', 'Yeterli Stok Yok.');
                    }
                }
            }
            $tukenenUrunler .= $tukenenUrunler != "" ? " ürünleri tükendi." : "";
            satislar::create([
                'urun_id' => $urunler[$i],
                'satis_miktari' => $miktarlar[$i]
            ]);
            /*            harcamalar::create([
                            'malzeme_id' => $urunler[$i],
                            'harcama_turu' => 'satis'
                        ]);*/
        }
        DB::commit();


        return $tukenenUrunler != "" ? redirect()->route('satis-listele')->with('status', $tukenenUrunler) : redirect()->route('satis-listele');
    }

    public function kayipEkle()
    {
        $urunler = malzemeler::all();

        return view('dashboard.kayip-ekle', compact('urunler'));
    }

    public function kayipKaydet(Request $request)
    {
        $urunler = $request->urun;
        $miktarlar = $request->urun_miktar;

        for ($i = 0; $i < count($urunler); $i++) {
            if (empty($urunler[$i]) || empty($miktarlar[$i]))
                return back()->with('status', 'Lütfen Geçerli Değerler Giriniz.');

            $malzemeler = malzemeler::where('id', $urunler[$i])->first();
            $alinan = alinanlar::where('malzeme_id', $malzemeler->id)
                ->where('stok_miktar', '>', 0)
                ->orderBy('created_at', 'desc')
                ->get();
            $tutar = 0;
            if (count($alinan) <= 0) {
                return back()->with('status', 'yeterli ürün yok');
            }
            $alinan[0]->stok_miktar = $alinan[0]->stok_miktar - $miktarlar[$i];
            if ($alinan[0]->stok_miktar >= 0) {
                $alinan[0]->update();
            } else {
                return back()->with('status', 'stok yetersiz');
            }
            harcamalar::create([
                'malzeme_id' => $urunler[$i],
                'harcama_turu' => 'kayip',
                'harcama_miktari' => $tutar
            ]);
        }

        $urunler = $request->urun;
        $miktarlar = $request->urun_adet;
        $fiyatlar = $request->adet_fiyat;

        for ($i = 0; $i < count($urunler); $i++) {
            if (empty($urunler[$i]) || empty($miktarlar[$i]))
                continue;

        }

        return redirect()->route('satis-listele');
    }

    public function alimListele()
    {
        $alimlar = alinanlar::leftJoin('malzemeler', 'malzeme_id', 'malzemeler.id')
            ->orderBy('alinanlar.created_at', 'desc')
            ->get(["malzeme_adi", "alinan_miktar", "miktar_tipi", "toplam_fiyat", "alinanlar.created_at"]);

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
                return back()->with('status', 'Lütfen Geçerli Değerler Giriniz.');
            alinanlar::create([
                'malzeme_id' => $malzemeler[$i],
                'alinan_miktar' => $miktarlar[$i],
                'stok_miktar' => $miktarlar[$i],
                'toplam_fiyat' => $fiyatlar[$i]
            ]);
        }

        return redirect()->route('alim-listele');
    }

    public function sonSilineniGeriAl()
    {
        $sonUrun = urunler::withTrashed()->orderByDesc('deleted_at')->first();
        $sonMalzeme = malzemeler::withTrashed()->orderByDesc('deleted_at')->first();

        if (($sonUrun == null && $sonMalzeme == null) || ($sonMalzeme?->deleted_at == null && $sonUrun?->deleted_at == null))
            return redirect()->route('urun-listele')->with('status', 'Geri alınacak bir şey yok.');

        if ($sonMalzeme?->deleted_at > $sonUrun?->deleted_at) {
            $sonMalzeme->restore();
            $mesaj = $sonMalzeme->malzeme_adi . ' ürünü';
        } else {
            $sonUrun->restore();
            $mesaj = $sonUrun->urun_adi . ' reçetesi';
        }

        return redirect()->route('urun-listele')->with('status', 'Silinen ' . $mesaj . ' başarıyla geri alındı');
    }

}
