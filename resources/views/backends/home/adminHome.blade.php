@extends('layouts.appBackend')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard')

@push('css-adminHome')
    <style>
        .bold-text {
            font-weight: 900;
            color: #0000CD;
        }
    </style>
@endpush

@section('content')
    <section class="row">
        {{-- Menampilkan Alert --}}
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {!! session('success') !!}  di Sketch Food.
            </div>
        @endif

        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Reservasi</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahReservasi }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Semua Menu</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahMenu }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Belum Bayar</h6>
                                    <h6 class="font-extrabold mb-0">{{ $belumBayar }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Sudah Bayar</h6>
                                    <h6 class="font-extrabold mb-0">{{ $sudahBayar }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ Auth::user()->avatarUrl }}" alt="Profile Picture"
                                class="rounded-circle" style="width: 50px; height: 50px;">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">Hi, <b>{{ Auth::user()->name }}</b></h5>
                            <h6 class="text-muted mb-0">@<x>{{ Auth::user()->role == 'admin' ? 'Administrator' : 'User' }}
                                </x>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-adminHome')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
