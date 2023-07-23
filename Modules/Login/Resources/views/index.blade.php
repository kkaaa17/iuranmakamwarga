@extends('login::layouts.master')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>IURAN MAKAM WARGA</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Login</p>

                <form action="/login/proses" method="POST" enctype="multipart/form-data">
                    @csrf
                    @error('username')
                        {{ $message }}
                    @enderror
                    <div class="input-group mb-3">
                        <input type="username" name="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" placeholder="Username / NIP" autofocus required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        {{ $message }}
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
