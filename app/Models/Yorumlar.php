<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Yorumlar extends Model
{

    use SoftDeletes;

    protected $table = "yorumlar";
    protected $guarded = [];
    protected $dates=['olusturulma_tarihi'];

    const CREATED_AT = 'olusturulma_tarihi';
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';


    public function kullanici()
    {
        return $this->belongsTo('App\Models\Kullanici');
    }

    public function urun()
    {
        return $this->belongsTo('App\Models\Urun');
    }


}
