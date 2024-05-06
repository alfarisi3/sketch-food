@extends('layouts.appFrontend')

@section('content')
    <div class="registerback">

        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- masuk -->
        <div class="container">
            <div class="register">
                <div class="header">
                    <h1>Register</h1>
                </div>
                <div class="main">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <span>
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukan nama lengkap anda">

                            @error('name')
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </span>

                        <br>

                        <span>
                            <label for="name">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Masukan nomor telepon">

                            @error('phone')
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </span>

                        <br>

                        <span>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukn alamat email">

                            @error('email')
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </span>

                        <br>

                        <span>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Buat password">

                            @error('password')
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </span>


                        <button type="submit" class="btn btn-outline-light">Register</button>

                        <div class="lupapw">
                            <div class="col d-flex justify-content-between">
                                <p>sudah punya akun?<a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- masuk -->
    </div>
@endsection
