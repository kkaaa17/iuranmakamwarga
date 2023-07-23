@extends('master')
@section('breadcrumb1', 'Laporan')
@section('breadcrumb2', 'Home')
@section('breadcrumb3', 'Laporan')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @php
                                $harini = DB::table('iuran')
                                ->whereDate('tglbayar', '=', date('Y-m-d'))
                                    ->sum('iuran.totalbayar');
                            @endphp
                            <h3>{{$harini}}</h3>

                            <p>Total Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/iuran" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            @php
                                $minggu = DB::table('iuran')
                                ->whereBetween('tglbayar', [\Carbon\Carbon::now()->subWeek()->format("Y-m-d"), \Carbon\Carbon::now()])
                                    ->sum('iuran.totalbayar');
                            @endphp
                            <h3>RP.{{$minggu}}<sup style="font-size: 20px"></sup></h3>

                            <p>Total Minggu Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/iuran" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            @php
                                $bulan = DB::table('iuran')
                                ->whereMonth('tglbayar', '=', date('m'))
                                    ->sum('iuran.totalbayar');
                            @endphp
                            <h3>RP.{{$bulan}}<sup style="font-size: 20px"></sup></h3>

                            <p>Total Bulan Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/iuran" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="container-fluid">

                <div class="card" id="tambahData">
                    <div class="card-header">
                        <h3 class="card-title">Filter Data </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET" enctype="multipart/form-data" id="FrmAkun">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama" class="col-form-label">Tanggal Awal :</label>
                                        <input type="date" class="form-control form-control-sm" name="tglawal" id="tglawal"
                                            autocomplete="off" placeholder="Pilih Tanggal Awal"  required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ttl" class="col-form-label">Tanggal Akhir :</label>
                                        <input type="date" class="form-control form-control-sm" name="tglakhir" id="tglakhir"
                                            autocomplete="off" placeholder="Pilih Tanggal Akhir"  required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                <span class="fa fa-paper-plane"></span> Simpan
                            </button>
                        </form>
                    </div>
                </div>        
            </div>
            <!-- /.row (main row) -->
            @php
                if (Request::get('tglawal')) {
            @endphp
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Laporan Dari Tanggal</h3>
                    {{-- <button type="button" data-toggle="collapse" data-target="#tambahData" class="btn btn-primary float-right">
                        <span class="fa fa-plus"></span> Tambah
                    </button> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataRecycle" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Nama Warga</th>
                            <th>Bayar</th>
                            <th>Total Bayar</th>
                            <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                        $no=1;
                        @endphp
                        @foreach ($data as $dt)
                        @php
                        $bayar = $dt->totalbayar/20000;
                        @endphp
                        <tr>
                        <td>{{$no++}}</td>
                        <td>{{$dt->nama}}</td>
                        <td>{{$bayar}}</td>
                        <td>{{$dt->totalbayar}}</td>
                        <td>{{$dt->tglbayar}}</td>
                    </tr>
                    @endforeach
                        {{-- @empty --}}
                        {{-- Data Belum Ada --}}
                        </tbody>
                    </table>
                </div>
        </div><!-- /.container-fluid -->
        @php
    }
        @endphp
    </section>
    <script>
        $(document).ready(function(){
            $("#dataRecycle").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons":["excel","colvis"]
            }).buttons().container().appendTo('#dataRecycle_wrapper .col-md-6:eq(0)');
        });
    </script>
            
@endsection
