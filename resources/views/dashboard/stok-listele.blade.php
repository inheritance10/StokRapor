@extends('layout')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Stok</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Ürün Adı</th>
                                <th class="border-top-0">Kalan Miktar</th>
                                <th class="border-top-0">Miktar Tipi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($malzemeler as $malzeme)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$malzeme->malzeme_adi}}</td>
                                    <td>{{$malzeme->miktar}}</td>
                                    <td>{{$malzeme->miktar_tipi}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="white-box">
                    <h3 class="box-title">Bu Ay Harcanan Tutarlar</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Ürün Adı</th>
                                <th class="border-top-0">Harcama Tutarı</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($malzemeGiderler as $malzemeGider)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$malzemeGider->malzeme_adi}}</td>
                                    <td>{{$malzemeGider->fiyat }}</td>
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

