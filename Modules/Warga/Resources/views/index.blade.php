@extends('master')
@section('breadcrumb1', 'Warga')
@section('breadcrumb2', 'Pengaturan')
@section('breadcrumb3', 'Warga')

@section('content')
    <div class="container-fluid">

        <div class="card" id="tambahData">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Warga</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/warga/store')}}" method="POST" enctype="multipart/form-data" id="FrmAkun">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik" class="col-form-label">Nomor Induk Kependudukan :</label>
                                <input type="text" class="form-control form-control-sm" name="nik" id="nik"
                                    autocomplete="off" placeholder="Nomor Induk Kependudukan"  required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama" class="col-form-label">Nama Lengkap :</label>
                                <input type="text" class="form-control form-control-sm" name="nama" id="nama"
                                    autocomplete="off" placeholder="Nama Lengkap"  required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ttl" class="col-form-label">Tempat, Tanggal Lahir :</label>
                                <input type="text" class="form-control form-control-sm" name="ttl" id="ttl"
                                    autocomplete="off" placeholder="Tempat, Tanggal Lahir"  required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat :</label>
                                <input type="text" class="form-control form-control-sm" name="alamat" id="alamat"
                                    autocomplete="off" placeholder="Alamat"  required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jk" class="col-form-label">Jenis Kelamin :</label>
                                <select class="form-control form-control-sm" name="jk" id="jk">
                                <option value="P">P</option>
                                <option value="L">L</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nohp" class="col-form-label">Nomor Handphone :</label>
                                <input type="text" class="form-control form-control-sm" name="nohp" id="nohp"
                                    autocomplete="off" placeholder="Nomor Handphone"  required>
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
                <h3 class="card-title mt-2">Data Warga</h3>
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
                        <th>Nonor Induk Kependudukan</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor Handphone</th>
                        <th>Iuran</th>
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
                        <td>{{$dt->iuran}}</td>
                        <td>
                            <a href="{{ url('warga/edit/'.$dt->nik) }}" class="btn btn-danger" type="edit">
                                edit
                            </a>
                            <a href="{{ url('warga/destroy/'.$dt->nik) }}" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" class="btn btn-danger" type="hapus">
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
                            <th>Nama Lengkap</th>
                            <td class="nama"></td>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td class="ttl"></td>
                        <tr>
                            <th>Alamat</th>
                            <td class="alamat"></td>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td class="jk"></td>
                        <tr>
                            <th>Nomor Handphone</th>
                            <td class="nohp"></td>
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
