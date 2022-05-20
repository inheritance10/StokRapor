@extends('layout')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Three charts -->
        <!-- ============================================================== -->
        <div class="row justify-content-center">
            <div onclick="window.location.href = '/stok-listele';" class="btn col-lg-3 col-md-12">
                <div style="border-style: groove; border-radius: 10px;" class="white-box analytics-info">
                    <h3 class="box-title">Stoklar</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash">
                                <canvas width="67" height="30"
                                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
{{--                        <li class="ms-auto"><span class="counter text-success">{{$toplamSatis}} adet</span></li>--}}
                    </ul>
                </div>
            </div>
            <div onclick="window.location.href = '/recete-listele';" class="btn col-lg-3 col-md-12">
                <div style="border-style: groove; border-radius: 10px;" class="white-box analytics-info">
                    <h3 class="box-title">Reçeteler</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash2">
                                <canvas width="67" height="30"
                                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
{{--                        <li class="ms-auto"><span class="counter text-purple">{{$toplamAlis}} ₺</span></li>--}}
                    </ul>
                </div>
            </div>
            <div onclick="window.location.href = '/satis-listele';" class="btn col-lg-3 col-md-12">
                <div style="border-style: groove; border-radius: 10px;" class="white-box analytics-info">
                    <h3 class="box-title">Satışlar</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash3">
                                <canvas width="67" height="30"
                                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
{{--                        <li class="ms-auto"><span class="counter text-info">{{$kayipMiktar}} ₺</span>--}}
                        </li>
                    </ul>
                </div>
            </div>
            <div onclick="window.location.href = '/alim-listele';" class="btn col-lg-3 col-md-12">
                <div style="border-style: groove; border-radius: 10px;" class="white-box analytics-info bg-green">
                    <h3 class="box-title">Alımlar</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0 float-left">
                        <li>
                            <div id="sparklinedash4">
                                <canvas width="67" height="30"
                                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
{{--                        <li class="ms-auto"><span class="counter text-info">{{$kayipMiktar}} ₺</span>--}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->

        <!-- ============================================================== -->
{{--
        <!-- RECENT SALES -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Recent sales</h3>
                        <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                            <select class="form-select shadow-none row border-top">
                                <option>March 2021</option>
                                <option>April 2021</option>
                                <option>May 2021</option>
                                <option>June 2021</option>
                                <option>July 2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>5</td>
                                <td class="txt-oflo">Hosting press html</td>
                                <td>SALE</td>
                                <td class="txt-oflo">April 21, 2021</td>
                                <td><span class="text-success">$24</span></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td class="txt-oflo">Digital Agency PSD</td>
                                <td>SALE</td>
                                <td class="txt-oflo">April 23, 2021</td>
                                <td><span class="text-danger">-$14</span></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td class="txt-oflo">Helping Hands WP Theme</td>
                                <td>MEMBER</td>
                                <td class="txt-oflo">April 22, 2021</td>
                                <td><span class="text-success">$64</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
--}}

    </div>

@endsection
@section('css')
@endsection

@section('js')
@endsection
