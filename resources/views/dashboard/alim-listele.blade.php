@extends('layout')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class='geri-don'>
                <a class="btn btn-warning show-mobile" href="{{route('dashboard')}}">Anasayfaya Dön</a>
            </div>

            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Alımlar</h3>
                    <a href="{{route('alim-ekle')}}"
                       class="btn btn-danger text-white" >
                        Alım Ekle</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Malzeme Adı</th>
                                <th class="border-top-0">Alınan Miktar</th>
                                <th class="border-top-0">Toplam Tutar</th>
                                <th class="border-top-0">Birim Fiyatı(kg-adet-litre)</th>
                                <th class="border-top-0">Tarih</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alimlar as $alim)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$alim->malzeme_adi}}</td>
                                    <td>{{$alim->alinan_miktar . " " . $alim->miktar_tipi}}</td>
                                    <td>{{$alim->toplam_fiyat}}₺</td>
                                    <td>{{number_format($alim->miktar_tipi == 'adet' ? $alim->toplam_fiyat / $alim->alinan_miktar  : ($alim->toplam_fiyat / $alim->alinan_miktar) * 1000, 2) }}₺</td>
                                    <td>{{$alim->created_at->format('Y-m-d')}}</td>
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

@endsection

