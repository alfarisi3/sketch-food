@extends('layouts.appFrontend')

@section('title', 'Input Reservation -')

@section('content')
    <div class="inputreservationback">
        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- masuk -->
        <div class="container">
            <div class="input-data">
                <div class="header">
                    <h1>Reservation</h1>
                </div>
                <div class="main">
                    <form action="{{ route('inputReservation.store') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <span>
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" placeholder="Masukan nama lengkap anda"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-lg-8">
                                <span>
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                        placeholder="Masukn alamat email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-4">
                                <span>
                                    <label for="phone">Nomor Telepon</label>
                                    <input type="text" id="phone" name="phone"
                                        "class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                        placeholder="No. Telepon">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <span>
                                            <label for="date">Tanggal</label>
                                            <input type="date" id="date" name="date"
                                                class="form-control @if ($errors->has('date')) is-invalid @endif"
                                                value="{{ old('date') }}" placeholder="Tanggal Reservasi"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <span>
                                            <label for="time">Jam</label>
                                            <input type="time" id="time" name="time"
                                                class="form-control @if ($errors->has('time')) is-invalid @endif"
                                                value="{{ old('time') }}" placeholder="Jam Reservasi"
                                                min="{{ \Carbon\Carbon::now()->format('H:i') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <span>
                                    <label for="table_id">Meja</label>
                                    <select class="form-select @error('table_id') is-invalid @enderror" name="table_id"
                                        id="table_id" style="border-radius: 15px">
                                        <option selected disabled>Pilih Meja</option>
                                        @foreach ($tables as $table)
                                            <option style="color: black" value="{{ $table->id }}">{{ $table->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                        </div>
                        @if ($table->total_meja - ($table->order ? $table->order->where('date', '>', now()->format('Y-m-d'))->count() : 0) > 0)
                            @if (Auth::check() &&
                                    Auth::user()->reservation &&
                                    Auth::user()->reservation->where('status', 'belum bayar')->count() > 0)
                                <button class="btn btn-outline-light" disabled>Tidak dapat melakukan reservasi </button>
                                <p class="text-secondary">Anda memiliki booking kamar yang sedang diproses dan belum
                                    dilakukan pembayaran</p>
                            @else
                                <button type="submit" class="btn btn-outline-light">Reservation</button>
                                <p class="text-secondary"><i>*Maksimal keterlambatan 3o menit</i></p>
                            @endif
                        @else
                            <button class="btn btn-outline-light" disabled>Meja Penuh</button>
                            <p class="text-secondary">maaf meja ang anda pilih sudah penuh</p>
                        @endif
                        <div class="lupapw">
                            <div class="col d-flex justify-content-between">
                                <p>Sudah reservasi?<a href="{{ route('inputReservation.status') }}">Lihat sekarang</a></p>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- masuk -->
    </div>
@endsection

@push('js-input-reservation')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
