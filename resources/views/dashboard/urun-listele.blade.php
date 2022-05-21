@extends('layout')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class='geri-don'>
                <a class="btn btn-warning show-mobile" href="{{url()->previous()}}">Geri</a>
            </div>

            <div class="col-sm-12">
                @if(session()->has('status'))
                    <div class="alert alert-info">
                        <h4>
                            {{session('status')}}
                        </h4>
                    </div>
                @endif
                    <a href="{{route('son-silineni-getir')}}"
                       style=" font-weight: bold; font-size: 18px"
                       class="btn btn-success text-white">
                        Son Silineni Geri Getir</a>
                <div class="white-box">
                    <h3 class="box-title">Reçeteler</h3>
                    <a href="{{route('urun-ekle')}}"
                       class="btn btn-danger text-white">
                        Reçete Ekle</a>
                    <a href="{{route('malzeme-ekle')}}"
                       class="btn btn-warning text-white">
                        Ürün Ekle</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Reçete Adı</th>
                                <th class="border-top-0">Ürün Adedi</th>
                                <th class="border-top-0">Maliyet Tutarı</th>
                                <th class="border-top-0">Detay</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($urunler as $urun)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$urun->urun_adi}}</td>
                                <td>{{$urun->adet}}</td>
                                <td>{{number_format($urun->toplam, 2)}}₺</td>
                                <td>
                                    <div class="row">
                                    <div class="col-auto">
                                        <a id="btn3" data="{{$urun->id}}"
                                           class="btn btn-info text-white detay" target="_blank">
                                            <i class="fa fa-info" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-auto">
                                        <a href="urun-duzenle?id={{$urun->id}}"
                                           class="btn btn-warning text-white">
                                            <i class="fa fa-edit" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-auto">
                                        <form id="urun-sil-form" action="recete-sil/{{$urun->id}}" method="post">
                                            @csrf
                                            <button type="button" onclick="myFunction()" title="Reçeteyi Sil"
                                                    class="btn btn-danger text-white">
                                                <i class="fa fa-remove" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('css')
    <style>

        @media only screen and (min-width: 767px) {
            .show-mobile {
                display: none;
            }
        }
    </style>@endsection

@section('js')
    <!-- jQuery 3 -->
    <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        $('.detay').on('click', function () {
            $.get("malzemeleri-getir/" + $(this).attr('data'), function (data) {
                Swal.fire({
                    icon: 'info',
                    html: JSON.stringify(data),
                    confirmButtonText: 'Onayla',
                })
            });
            console.log($(this).attr('data'))

            });
        function myFunction() {
            let text = "Silmek Sitediğinizden emin misiniz.";
            if (confirm(text) == true) {
                document.getElementById("urun-sil-form").submit();
            } else {

            }
        }

    </script>
@endsection

