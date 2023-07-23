@extends('master')
@section('breadcrumb1', 'Dashboard')
@section('breadcrumb2', 'Home')
@section('breadcrumb3', 'Dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @php
                                $hitungwarga=DB::table('warga')->count();
                            @endphp
                            <h3>{{$hitungwarga}}</h3>

                            <p>WARGA</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/warga" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            @php
                                $totalbayar = DB::table('iuran')
                                    ->sum('iuran.totalbayar');
                            @endphp
                            <h3>RP.{{$totalbayar}}<sup style="font-size: 20px"></sup></h3>

                            <p>IURAN MAKAM WARGA</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/iuran" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
