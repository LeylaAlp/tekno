<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yorumlar extends Model
{
    protected $table = "yorumlar";
    protected $guarded = [];

    const CREATED_AT = 'olusturulma_tarihi';
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';


    public function kullanici()
    {
        return $this->belongsTo('App\Models\Kullanici');
    }


}
