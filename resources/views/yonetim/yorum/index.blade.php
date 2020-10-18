@extends('yonetim.layouts.master')
@section('title','Yorumlar')

@section('content')

    <div class="page-container">

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">





                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">


                                <form class="form-header" action="{{ route('yonetim.yorum') }}" method="POST">
                                    @csrf
                                    <input class="au-input au-input--xl" type="text" name="aranan" value="{{ old('aranan') }}" placeholder="Yorum Ara.." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                    <a class="au-btn--submit" type="button" href="{{ route('yonetim.yorum') }}">
                                        <span class="btn-outline-danger">  Temizle </span>
                                    </a>


                                </form>

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
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>Yorum</th>
                                        <th>Kayıt Tarihi</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $entry)
                                        <tr>
                                            <td>{{ $entry->id }}</td>
                                            <td>{{ $entry->kullanici->email }}</td>
                                            <td>{{ substr($entry->yorum,0,70) }}...</td>

                                            <td>{{ $entry->olusturulma_tarihi->isoFormat('LLLL') }}</td>

                                            <td>
                                                <a href="{{ route('yonetim.yorum.duzenle',$entry->id) }}"><span
                                                        class="btn-outline-success">İncele</span></a>
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
                    location.href = "/yonetim/yorum/sil/" + destroy_id;

                },
                function () {
                    alertify.error('Silme İşlemi Başarısız!')
                }
            )


        });
    </script>


@endsection
