<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Urun;
use Illuminate\Support\Str;
use App\Models\Kategori;
use App\Models\UrunDetay;
use App\Models\Siparis;

class SiparisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('aranan')) {
            $request->flash();

            $aranan = $request->aranan;
            $list = Siparis::with('sepet.kullanici')->where('adsoyad', 'like', "%$aranan%")
                ->orWhere('id','like', "%$aranan%")
                ->orderByDesc('id')
                ->paginate(8)
                ->appends('aranan', $aranan);
        } else {
            $request->flush();
            $list = Siparis::with('sepet.kullanici')->orderByDesc('id')->paginate(8);
        }

        return view('yonetim.siparis.index', compact('list'));
    }


    public function form($id = 0)
    {
        if ($id > 0) {
            $entry = Siparis::with('sepet.sepet_urunler.urun')->find($id);
        }

        return view('yonetim.siparis.form', compact('entry'));
    }


    public function kaydet(Request $request, $id = 0)
    {


        $validation = $request->validate([
            'adsoyad' => 'required',
            'adres' => 'required',
            'telefon' => 'required',
            'durum' => 'required'
        ]);

        $data = $request->only('adsoyad', 'adres', 'telefon', 'ceptelefonu','durum');


        if ($id > 0) {
            $entry = Siparis::where('id', $id)->firstOrFail();
            $entry->update($data);
        }


        return redirect()->route('yonetim.siparis.duzenle', $entry->id)
            ->with('mesaj','Güncelleme İşlemi Başarılı')
            ->with('mesaj_tur', 'success');
    }


    public function sil($id)
    {

        Siparis::destroy($id);
        return redirect()->route('yonetim.siparis')
            ->with('mesaj', 'Silme İşlemi Başarılı')
            ->with('mesaj_tur', 'success');

    }


}
