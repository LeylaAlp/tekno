<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Yorumlar;

class YorumController extends Controller
{
    public function index(Request $request)
    {

        if ($request->filled('aranan')) {
            $request->flash();
            $aranan = $request->aranan;

            $list = Yorumlar::where('yorum', 'like', "%$aranan%")
                ->orderByDesc('id')
                ->paginate(8)
                ->appends('aranan', $aranan);
        } else {
            $request->flush();
            $list = Yorumlar::orderByDesc('id')->paginate(8);
        }

        return view('yonetim.yorum.index', compact('list'));
    }



    public function form($id = 0)
    {
        if ($id > 0) {
            $entry = Yorumlar::find($id);
        }

        return view('yonetim.yorum.form', compact('entry'));
    }


    public function sil($id)
    {
        $yorum = Yorumlar::find($id);
        $yorum->delete();

        return redirect()->route('yonetim.yorum')
            ->with('mesaj', 'Silme İşlemi Başarılı')
            ->with('mesaj_tur', 'success');

    }

}
