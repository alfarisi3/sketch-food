@extends('layouts.appFrontend')

@include('layouts.frontends.styles')

@section('content')
    <div class="loginback">
        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- masuk -->
        <div class="container">
            <div class="login">
                <div class="header">
                    <h1>Login</h1>
                </div>


                {{-- Menampilkan Alert --}}
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
                @endif

                <div class="main">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <span>
                            <iconify-icon icon="mdi:user" width="24" height="24" style="color: rgb(0, 0, 0)"></iconify-icon>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                            @enderror

                        </span><br>
                        <span>
                            <iconify-icon icon="bxs:lock" width="24" height="24" style="color: rgb(0, 0, 0)"></iconify-icon>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                            @enderror

                        </span><br>
                        <button type="submit" class="btn btn-outline-light">Login</button>

                        <div class="lupapw">
                            <div class="col d-flex justify-content-between">
                                <p>Belum punya akun?<a href="{{ route('register') }}">Register</a></p>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Lupa Password?</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- masuk -->
    </div>
@endsection

@push('js-login')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
