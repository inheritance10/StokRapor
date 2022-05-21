@extends('layout')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-sm-6">
                @if(session()->has('status'))
                    <div class="alert alert-info">
                        <h4>
                            {{session('status')}}
                        </h4>
                    </div>
                @endif
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
                                <th class="border-top-0">İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($malzemeler as $malzeme)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$malzeme->malzeme_adi}}</td>
                                    <td>{{$malzeme->miktar ?? "Alım Yapılmadı"}}</td>
                                    <td>{{$malzeme->miktar_tipi}}</td>
                                    <td>
                                        <form id="urun-sil-form" action="urun-sil/{{$malzeme->id}}" method="post">
                                            @csrf
                                            <button type="button" onclick="myFunction()" title="Ürünü Sil"
                                                    class="urun-sil btn btn-danger text-white">
                                                Ürünü Sil
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="row">
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
                                @if($malzemeGider->fiyat)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$malzemeGider->malzeme_adi}}</td>
                                    <td>{{$malzemeGider->fiyat }}</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>--}}
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
    <script>
        function myFunction() {
            let text = "Silmek Sitediğinizden emin misiniz.";
            if (confirm(text) == true) {
                document.getElementById("urun-sil-form").submit();
            } else {

            }
        }
    </script>
@endsection

