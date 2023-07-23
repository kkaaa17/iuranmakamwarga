@extends('master')
@section('breadcrumb1', 'Warga')
@section('breadcrumb2', 'Pengaturan')
@section('breadcrumb3', 'Warga')

@section('content')
    <div class="container-fluid">

        <div class="card" id="tambahData">
            <div class="card-header">
                <h3 class="card-title">Edit Data Warga</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/warga/update/'.$data->nik)}}" method="POST" enctype="multipart/form-data" id="FrmAkun">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik" class="col-form-label">Nomor Induk Kependudukan :</label>
                                <input type="text" class="form-control form-control-sm" name="nik" id="nik"
                                    autocomplete="off" placeholder="Nomor Induk Kependudukan"  value="{{ $data->nik }}" readonly required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama" class="col-form-label">Nama Lengkap :</label>
                                <input type="text" class="form-control form-control-sm" name="nama" id="nama"
                                    autocomplete="off" placeholder="Nama Lengkap"  value="{{ $data->nama }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ttl" class="col-form-label">Tempat, Tanggal Lahir :</label>
                                <input type="text" class="form-control form-control-sm" name="ttl" id="ttl"
                                    autocomplete="off" placeholder="Tempat, Tanggal Lahir"  value="{{ $data->ttl }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat :</label>
                                <input type="text" class="form-control form-control-sm" name="alamat" id="alamat"
                                    autocomplete="off" placeholder="Alamat"  value="{{ $data->alamat }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jk" class="col-form-label">Jenis Kelamin :</label>
                                <select class="form-control form-control-sm" name="jk" id="jk">
                                <option value="{{$data->jk}}">{{$data->jk}} (dipilih)</option>
                                <option value="P">P</option>
                                <option value="L">L</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nohp" class="col-form-label">Nomor Handphone :</label>
                                <input type="text" class="form-control form-control-sm" name="nohp" id="nohp"
                                    autocomplete="off" placeholder="Nomor Handphone" value="{{$data->nohp}}" required>
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
@endsection
