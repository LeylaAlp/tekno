<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urun;
use Illuminate\Support\Facades\Auth;
use App\Models\Yorumlar;

class UrunController extends Controller
{
    public function index(Request $request, $slug_urunadi)
    {


        if ($request->isMethod('POST')) {
            $yorumlar = Urun::find($request->id);

            $kullanici = Auth::user()->id;


            $a = Yorumlar::where(['kullanici_id' => $kullanici, 'urun_id' =>$yorumlar->id])->get();
//        dd($a,$b);

            if (!filled($a)) {
                $ekle = Yorumlar::create([
                    'urun_id' => $yorumlar->id,
                    'kullanici_id' => $kullanici,
                    'yorum' => $request->yorum
                ]);
            }

//
//            $urun = Urun::whereSlug($slug_urunadi)->firstOrFail();
//            $kategoriler = $urun->kategoriler()->distinct()->get();
//            $comment = Yorumlar::where('urun_id', $yorumlar->id)->get();
        }

            $yorum = Urun::whereSlug($slug_urunadi)->get();
            $urun = Urun::whereSlug($slug_urunadi)->firstOrFail();
            $kategoriler = $urun->kategoriler()->distinct()->get();

            foreach ($yorum as $u) {
                 $u->id;
            }
            $comment = Yorumlar::where('urun_id', $u->id)->get();



        return view('urun', compact('urun', 'kategoriler', 'comment'));
    }


    public function ara(Request $request)
    {
        $request->flash();
        $aranan = $request->input('aranan');
        $urunler = Urun::where('urun_adi', 'like', "%$aranan%")
            ->orWhere('aciklama', 'like', "%$aranan%")
            ->paginate(8);
//            ->get();


        return view('arama', compact('urunler'));

    }
}
