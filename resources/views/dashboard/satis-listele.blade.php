@extends('layout')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Bu Ayın Satışları</h3>
                    <a href="{{route('satis-ekle')}}"
                       class="btn btn-info text-white" target="_blank">
                        Satış Oluştur</a>
                    <a href="{{route('satis-ekle')}}"
                       class="btn btn-danger text-white" target="_blank">
                        Kayıp Oluştur</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Ürün Adı</th>
                                <th class="border-top-0">Toplam Satış Adedi</th>
                                <th class="border-top-0">Adet Fiyatı</th>
                                <th class="border-top-0">Toplam Gelir</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($satislar as $satis)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$satis['urun_adi']}}</td>
                                <td>{{$satis['toplam_satis']}}</td>
                                <td>{{$satis['adet_fiyati']}}</td>
                                <td>{{$satis['toplam_gelir']}} ₺</td>
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
@endsection

@section('js')
    <!-- jQuery 3 -->
    <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>

@endsection

