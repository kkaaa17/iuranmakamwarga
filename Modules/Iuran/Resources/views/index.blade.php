@extends('master')
@section('breadcrumb1', 'Iuran')
@section('breadcrumb2', 'Pengaturan')
@section('breadcrumb3', 'Iuran')

@section('content')
    <div class="container-fluid">

        <div class="card" id="tambahData">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Iuran</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/iuran/store')}}" method="POST" enctype="multipart/form-data" id="FrmAkun">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik" class="col-form-label">Nama Penduduk:</label>
                                <select class="select2 form-control form-control-sm" name="nik" id="nik">
                                    @foreach ($datawarga as $dtwarga)
                                    <option value="{{$dtwarga->nik}}">{{$dtwarga->nama}}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jk" class="col-form-label">Bayar :</label>
                                <select class="form-control form-control-sm" name="bayar" id="bayar" onchange="changer()">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                </select>
                                <script type='text/javascript'>
                                    function changer(){
                                        val = document.getElementById("bayar").value;
                                        var total = val*20000
                                        document.getElementById("totalbayar").value = total;
                                    }
                                  </script>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama" class="col-form-label">Total Bayar :</label>
                                <input type="text" class="form-control form-control-sm" name="totalbayar" id="totalbayar"
                                    autocomplete="off" placeholder="Total Bayar" value="20000" readonly  required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ttl" class="col-form-label">Tanggal Bayar :</label>
                                <input type="date" class="form-control form-control-sm" name="tglbayar" id="tglbayar"
                                    autocomplete="off" placeholder="Tanggal Bayar"  required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">
                        <span class="fa fa-paper-plane"></span> Simpan
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">Data Iuran</h3>
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
                        <th>Nama Lengkap</th>
                        <th>Bayar</th>
                        <th>Bayar</th>
                        <th>Total Bayar</th>
                        <th>Tanggal Bayar</th>
                        <th>Opsi</th>
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
                        <td>
                            <a href="{{ url('iuran/destroy/'.$dt->id) }}" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" class="btn btn-danger" type="hapus">
                                hapus
                            </a>
                        </td>
                    </tr>
                    {{-- @empty --}}
                    {{-- Data Belum Ada --}}
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="modal fade" id="modalDetail">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Detail Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-stripped table-bordered">
                        <tr>
                            <th>Nomor Induk Kependudukan</th>
                            <td class="nik"></td>
                        <tr>
                            <th>Total Bayar</th>
                            <td class="totalbayar"></td>
                        <tr>
                            <th>Tanggal bayar</th>
                            <td class="tglbayar"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalRecycle">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Detail Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="dataRecycle" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Nonor Induk Kependudukan</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor Handphone</th>
                            <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @foreach ($data as $dt)
                            <tr>
                            <td>{{$no++}}</td>
                            <td>{{$dt->nik}}</td>
                            <td>{{$dt->nama}}</td>
                            <td>{{$dt->ttl}}</td>
                            <td>{{$dt->alamat}}</td>
                            <td>{{$dt->jk}}</td>
                            <td>{{$dt->nohp}}</td>
                            <td>
                                <button class="btn btn-danger" type="edit">
                                    edit
                                <button class="btn btn-danger" type="hapus">
                                    hapus
                                </button>
                            </td>
                        </tr>
                        {{-- @empty --}}
                        {{-- Data Belum Ada --}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
