@extends('yonetim.layouts.master')
@section('title','Sipariş Yönetimi')

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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">


                                <form class="form-header" action="{{ route('yonetim.siparis') }}" method="POST">
                                    @csrf
                                    <input class="au-input au-input--xl" type="text" name="aranan" value="{{ old('aranan') }}" placeholder="Sipariş Adı Ara.." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                    <a class="au-btn--submit" type="button" href="{{ route('yonetim.siparis') }}">
                                            <span class="btn-outline-danger">  Temizle </span>
                                        </a>

                                </form>

                                <a href="{{ route('yonetim.siparis.yeni') }}">
                                    <button class="btn btn-primary btn-md">
                                        <i class="zmdi zmdi-plus"></i> Yeni
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-30">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                    <tr>
                                        <th>Sipariş Kodu</th>
                                        <th>Kullanıcı</th>
                                        <th>Tutar</th>
                                        <th>Durum</th>
                                        <th>Sipariş Tarihi</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $entry)
                                        <tr>
                                            <td>SP-000{{ $entry->id }}</td>
                                            <td>{{ $entry->sepet->kullanici->adsoyad }}</td>
                                            <td>{{ $entry->siparis_tutari * ((100+config('cart.tax')) / 100) }} ₺</td>
                                            <td>{{ $entry->durum }}</td>
                                            <td>{{ $entry->olusturulma_tarihi->isoFormat('LLLL') }}</td>

                                            <td>
                                                <a href="{{ route('yonetim.siparis.duzenle',$entry->id) }}"><span
                                                        class="btn-outline-success">Düzenle</span></a>
                                            </td>

                                            <td>
                                                <a href="javascript:void(0)"><span id="{{ $entry->id }}"
                                                                                   class="btn-outline-danger">Sil</span></a>
                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        {{ $list->links() }}

                        <!-- END DATA TABLE-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        $(".btn-outline-danger").click(function () {
            destroy_id = $(this).attr('id');
            alertify.confirm('Silme İşlemini Onaylayın', 'Bu işlem Geri Alınamaz!',
                function () {
                    location.href = "/yonetim/siparis/sil/" + destroy_id;

                },
                function () {
                    alertify.error('Silme İşlemi Başarısız!')
                }
            )


        });
    </script>


@endsection
