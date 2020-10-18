@extends('yonetim.layouts.master')
@section('title','Sipariş Yönetimi')


@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection



@section('content')

    <div class="page-container">

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">


                    @if(session()->has('mesaj'))
                        <div class="alert alert-{{ session('mesaj_tur') }} alert-dismissible fade show save"
                             role="alert">
                            <strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                                {{ session('mesaj') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Siparis {{ $entry->id >0 ? 'Güncelle' : 'Kayıt' }} </strong> Formu
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ route('yonetim.siparis.kaydet',$entry->id) }}" method="post"
                                      enctype="multipart/form-data" class="form-horizontal">
                                    @csrf


                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Ad Soyad</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="adsoyad"
                                                   value="{{ old('adsoyad',$entry->adsoyad) }}"
                                                   placeholder="Ad Soyad Giriniz" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Telefon</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="number" id="text-input" name="telefon"
                                                   value="{{ old('telefon',$entry->telefon) }}"
                                                   placeholder="Telefon Giriniz" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Cep Telefonu</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="ceptelefonu"
                                                   value="{{ old('ceptelefonu',$entry->ceptelefonu) }}"
                                                   placeholder="Cep Telefonu Giriniz" class="form-control">
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="textarea-input" class=" form-control-label">Adres</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea name="adres" rows="5"
                                                      placeholder="Adres Giriniz"
                                                      class="form-control">{{ old('adres',$entry->adres) }}</textarea>
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="durum" class=" form-control-label">Durum</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="durum" id="select" class="form-control">
                                                <option {{old('durum',$entry->durum) == 'Siparişiniz Alındı' ? 'selected' : '' }}>
                                                    Siparişiniz Alındı
                                                </option>

                                                <option {{old('durum',$entry->durum) == 'Ödeme Onaylandı' ? 'selected' : '' }}>
                                                    Ödeme Onaylandı
                                                </option>

                                                <option {{old('durum',$entry->durum) == 'Kargoya Verildi' ? 'selected' : '' }}>
                                                    Kargoya Verildi
                                                </option>

                                                <option {{old('durum',$entry->durum) == 'Sipariş Tamamlandı' ? 'selected' : '' }}>
                                                    Sipariş Tamamlandı
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> {{ $entry->id >0 ? 'Güncelle' : 'Kaydet'  }}
                                    </button>


                                </form>

                                <br>
                                <br>

                                <table>
                                    <thead>
                                    <tr>
                                        <th>Ürün</th>
                                        <th>Tutar &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</th>
                                        <th>Adet &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;</th>
                                        <th>Ara Toplam</th>
                                        <th>Durum</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($entry->sepet->sepet_urunler as $sepet_urun)
                                        <tr>

                                            <td class="cart__product__item">
                                                <a  href="{{ route('urun',$sepet_urun->urun->slug) }}"><img width="130" height="150"
                                                        src="{{ $sepet_urun->urun->detay->urun_resmi!=null ?
                                             asset('/images/urunler/'.$sepet_urun->urun->detay->urun_resmi) : 'http://via.placeholder.com/130x150?text=UrunResmi'}}" alt=""></a>
                                                <div class="cart__product__item__title">
                                                    <h6><a href="{{ route('urun',$sepet_urun->urun->slug) }}">
                                                            <br>
                                                            {{ $sepet_urun->urun->urun_adi }}</a></h6>
                                                            <br>
                                                </div>
                                            </td>
                                            <td>{{ $sepet_urun->fiyati }} ₺</td>
                                            <td>
                                                <div>
                                                    <span>  {{ $sepet_urun->adet }} adet &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>
                                                </div>
                                            </td>

                                            <td>{{ $sepet_urun->fiyati * $sepet_urun->adet }} ₺</td>
                                            <td>{{ $sepet_urun->durum }}</td>

                                        </tr>

                                    @endforeach
                                    <tr>
                                        <th colspan="3" class="text-right">Toplam Tutar</th>
                                        <td colspan="1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ $entry->siparis_tutari }}
                                            ₺
                                        </td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-right">Toplam Tutar (KDV'li)</th>
                                        <td colspan="1"> &nbsp; &nbsp; &nbsp; &nbsp;
                                            &nbsp;{{ $entry->siparis_tutari * ((100+config('cart.tax'))/100) }} ₺
                                        </td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-right">Durum</th>
                                        <td colspan="1">&nbsp;&nbsp;&nbsp; {{ $entry->durum }}</td>
                                    </tr>

                                    </tbody>
                                </table>


                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>


    </div>

@endsection


