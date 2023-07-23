@extends('master')
@section('breadcrumb1', 'Akun')
@section('breadcrumb2', 'Pengaturan')
@section('breadcrumb3', 'Akun')

@section('content')
    <div class="container-fluid">

        <div class="card" id="tambahData">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Akun</h3>
            </div>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data" id="FrmAkun">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama :</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name"
                                    autocomplete="off" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="username" class="col-form-label">Username / NIP :</label>
                                <input type="text" class="form-control form-control-sm" name="username" id="username"
                                    autocomplete="off" placeholder="Username" value="{{ old('username') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password" class="col-form-label password">Password :</label>
                                <input type="password" class="form-control form-control-sm password" name="password"
                                    id="password" autocomplete="off" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="role" class="col-form-label">Role :</label>
                                <select name="role" id="role" class="form-control form-control-sm select2"
                                    autocomplete="off" value="{{ old('role') }}">
                                    <option value="">- Pilih Satu -</option>
                                    <option value="developer">Developer</option>
                                    <option value="Contoh1">Contoh1</option>
                                    <option value="Contoh2">Contoh2</option>
                                </select>
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
                <h3 class="card-title mt-2">Data Akun</h3>
                {{-- <button type="button" data-toggle="collapse" data-target="#tambahData" class="btn btn-primary float-right">
                    <span class="fa fa-plus"></span> Tambah
                </button> --}}
                <button type="button" class="btn btn-warning float-right" id="recycle">
                    <span class="fa fa-recycle"></span> Recycle
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataAkun" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
                            <th>Nama</th>
                            <td class="name"></td>
                        <tr>
                            <th>Username</th>
                            <td class="username"></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td class="role"></td>
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
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('users::js.akun')
@endsection
