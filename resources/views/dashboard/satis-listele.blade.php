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
                <div class="white-box">
                    <div class="card-body">
                        @if(session()->has('status'))
                            <div class="alert alert-warning">
                                <h4>
                                    {{session('status')}}
                                </h4>
                            </div>
                        @endif
                    <h3 class="box-title">Bu Ayın Satışları</h3>
                    <a href="{{route('satis-ekle')}}"
                       class="btn btn-info text-white" >
                        Satış Oluştur</a>
                    <a href="{{route('kayip-ekle')}}"
                       class="btn btn-danger text-white" >
                        Kayıp Oluştur</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Ürün Adı</th>
                                <th class="border-top-0">Toplam Satış Adedi</th>
                                <th class="border-top-0">Tarih</th>
{{--                                <th class="border-top-0">Adet Fiyatı</th>
                                <th class="border-top-0">Toplam Gider</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($satislar as $satis)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$satis['urun_adi']}}</td>
                                <td>{{$satis['toplam_satis']}}</td>
                                <td>{{$satis['created_at']->format('Y-m-d')}}</td>
{{--                                <td>{{$satis['adet_fiyati']}}</td>
                                <td>{{$satis['toplam_gider']}} ₺</td>--}}
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
    </style>
@endsection

@section('js')
    <!-- jQuery 3 -->
    <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>

@endsection

