@extends('layout')
@section('content')
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Reçete Ekle</h4>
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
            <div class='geri-don'>
                <a class="btn btn-warning show-mobile" href="{{url()->previous()}}">Geri</a>
            </div>
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

                        <form method="post" action="/urun-kaydet" class="form-horizontal form-material">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Ürün İsmi</label>
                                <div class="col-md-10 border-bottom p-0">
                                    <input type="text" name="urun_adi" placeholder="Pastırmalı Pizza"
                                           class="form-control p-0 border-0"></div>
                            </div>
                            <label class="col-sm-10">Malzeme Adı</label>
                            <div id="malzemeler">

                                <div id="malzeme" class="form-group mb-4">
                                    <div class="row">


                                        <div class="col-sm-10 border-bottom">
                                            <select name="malzeme[]"
                                                    class="form-select shadow-none p-0 border-0 form-control-line select2">
                                                <option disabled>Malzeme seç</option>
                                                @foreach($malzemeler as $malzeme)
                                                    <option value="{{$malzeme->id}}">{{$malzeme->malzeme_adi}}({{$malzeme->miktar_tipi}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 border-bottom p-0">
                                            <input type="number" name="malzeme_miktar[]" step="any" placeholder="Miktar (gr, adet, ml)"
                                                   class="form-control p-0 border-0"></div>
                                    </div>
                                    <div class="col-sm-2 border-bottom">
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-info mb-4" id="btn2">Malzeme Ekle</a>

                            <div class="form-group mb-4">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Reçeteyi Ekle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
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
    </style>    <!-- Select2 -->
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

