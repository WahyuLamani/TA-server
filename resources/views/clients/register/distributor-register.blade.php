@extends('layouts.apps')

@section('contents')
<main class="py-5 mt-5">
   
    <div class="container">
        @include('layouts.alert')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Distributor Register</h5>
                <div class="row">
                    <div class="col-md-12">
                        <form action="/distributor-register" method="POST" id="step-form-horizontal" class="step-form-horizontal" autocomplete="off">@csrf
                            <div>
                                <h4>Detail Akun</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" placeholder="First Name" value="{{ old('firstName') }}" required>
                                            </div>
                                            @error('firstName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" placeholder="Last Name" value="{{ old('lastName') }}" required>
                                            </div>
                                            @error('lastName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" required>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </section>
                                <h4>Alamat Lengkap</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat Lengkap" value="{{ old('address') }}" required>
                                            </div>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror" placeholder="Kota" value="{{ old('kota') }}" required>
                                            </div>
                                            @error('kota')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="kode Pos" value="{{ old('kode_pos') }}" required>
                                            </div>
                                            @error('kode_pos')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="telp_num" class="form-control @error('telp_num') is-invalid @enderror" placeholder="Nomor Telepon" value="{{ old('telp_num') }}" required>
                                            </div>
                                            @error('telp_num')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </section>
                                <h4>Konfirmasi</h4>
                                <section>
                                    <div class="row h-100">
                                        <div class="col-12 h-100 d-flex flex-column justify-content-center align-items-center">
                                            <h2>Mohon Konfirmasi Ulang Data Diri</h2>
                                            <p>Dengan mengklik tombol Mendaftar, Anda resmi menjadi mitra kami !!</p>
                                            <button type="submit" class="btn btn-primary">Mendaftar !</button>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
