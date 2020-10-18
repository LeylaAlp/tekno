@extends('yonetim.layouts.master')
@section('title','Yorum Yönetimi')


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
                                <strong>Yorum  </strong> Formu
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post"
                                      enctype="multipart/form-data" class="form-horizontal">
                                    @csrf


                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Ürün Resmi</label>
                                        </div>                                         <img src="/images/urunler/{{ $entry->urun->detay->urun_resmi }}" alt="Ürün Resmi"
                                                 style="height: 120px; width:100px; margin-right: 20px;" class="pull-left">

                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Ürün Adı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="urun_adi"
                                                   value="{{ $entry->urun->urun_adi }}"
                                                  class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Yorum</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea name="yorum" id="" cols="80" rows="10" disabled>{{ $entry->yorum }}</textarea>
                                        </div>
                                    </div>


                                    <br>


                                </form>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

