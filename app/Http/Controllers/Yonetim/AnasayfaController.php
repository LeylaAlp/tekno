<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Siparis;
use App\Models\Kullanici;
use App\Models\Urun;
use Illuminate\Support\Facades\Cache;


class AnasayfaController extends Controller
{
    public function index()
    {

        $bitisZamani = now()->addMinutes(10);
        $istatistikler = Cache::remember('istatistikler',$bitisZamani,function (){
            return[
                'bekleyen_siparis' => Siparis::where('durum', 'Siparişiniz Alındı')->count(),
                'toplam' => Siparis::toplam_kazanc(),
                'kullanici' => Kullanici::count(),
                'urun' => Urun::count()
            ];
        });


        return view('yonetim.anasayfa', compact('istatistikler'));
    }
}
