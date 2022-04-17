@extends('layout')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Ürünler</h3>
                    <a href="{{route('urun-ekle')}}"
                       class="btn btn-danger text-white" target="_blank">
                        Ürün Ekle</a>
                    <a href="{{route('malzeme-ekle')}}"
                       class="btn btn-warning text-white" target="_blank">
                        Malzeme Ekle</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Ürün Adı</th>
                                <th class="border-top-0">Malzeme Adedi</th>
                                <th class="border-top-0">Satış Fiyatı</th>
                                <th class="border-top-0">Detay</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($urunler as $urun)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$urun->urun_adi}}</td>
                                <td>{{$urun->adet}}</td>
                                <td>{{$urun->satis_fiyati}}</td>
                                <td><a id="btn3" data="{{$urun->id}}"
                                       class="btn btn-info text-white detay" target="_blank">
                                        Malzeme Detay</a></td>
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
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        $('.detay').on('click', function () {
            $.get("malzemeleri-getir/" + $(this).attr('data'), function (data) {
                Swal.fire({
                    icon: 'info',
                    text: JSON.stringify(data),
                    confirmButtonText: 'Onayla',
                })
            });
            console.log($(this).attr('data'))

            });
    </script>
@endsection

