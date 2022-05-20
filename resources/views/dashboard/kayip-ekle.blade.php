@extends('layout')
@section('content')
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Kayıp Ekle</h4>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-6 col-xlg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->has('status'))
                            <div class="alert alert-warning">
                                <h4>
                                    {{session('status')}}
                                </h4>
                            </div>
                        @endif

                        <form method="post" action="{{route('kayip-kaydet')}}" class="form-horizontal form-material">
                            @csrf
{{--                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Ürün İsmi</label>
                                <div class="col-md-10 border-bottom p-0">
                                    <input type="text" placeholder="Pastırmalı Pizza"
                                           class="form-control p-0 border-0">
                                </div>
                            </div>--}}
                            <label class="col-sm-10">Ürün Adı</label>
                            <div id="malzemeler">

                                <div id="malzeme" class="form-group mb-4">
                                    <div class="row">
                                        <div class="col-sm-10 border-bottom">
                                            <select name="urun[]"
                                                    class="form-select shadow-none p-0 border-0 form-control-line select2">
                                                @foreach($urunler as $urun)
                                                    <option value="{{$urun->id}}">{{$urun->malzeme_adi}}({{$urun->miktar_tipi}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 border-bottom p-0">
                                            <input type="number" step="any" name="urun_miktar[]" placeholder="Miktar"
                                                   class="form-control p-0 border-0"></div></div>
                                    <div class="col-sm-2 border-bottom">
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-info mb-4" id="btn2">Ürün Ekle</a>

                            <div class="form-group mb-4">
                                <div class="col-sm-12">
                                    <button class="btn btn-warning">Kayıbı Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
    </div>
@endsection
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="/select2/dist/css/select2.min.css">

@endsection

@section('js')
    <!-- jQuery 3 -->
    <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- Select2 -->
    <script src="/select2/dist/js/select2.full.min.js"></script>
    <script>
        var sayac = 0;
        $("#btn2").click(function () {
            $("#malzemeler").append($("#malzeme").html());
        });
    </script>

@endsection

