<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Siparis extends Model
{
    use SoftDeletes;

    protected $table = "siparis";
    protected $dates=['olusturulma_tarihi'];

    protected $fillable = ['sepet_id', 'siparis_tutari', 'durum', 'banka', 'taksit_sayisi','adsoyad','adres','telefon','ceptelefonu'];

    const CREATED_AT = 'olusturulma_tarihi';
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';


    public function sepet()
    {
        return $this->belongsTo('App\Models\Sepet');
    }

    public static function toplam_kazanc()
    {
        return DB::table('siparis')->sum('siparis_tutari');
    }


}
