@extends('layouts.appFrontend')

@section('title', 'Payment Menu -')

@section('content')

    <body>
        <div class="paymentback">
            <!-- navbar -->
            @include('layouts.frontends.navbar')
            <!-- navbar -->

            <!-- payment -->
            <div class="deskripsi-payment">
                <div class="container">
                    <h1>Payment</h1>
                    <p>Silahkan lakukan pembayaran dengan mentransfer ke salah satu bank yang tersedia.</p>
                    <h4>Uang muka Rp. 50.000</h4>
                    <div class="row">
                        @foreach ($banks as $bank)
                            <div class="col-lg-6">
                                <div class="bank">
                                    <div class="header">
                                        <h5>{{ $bank->bank_name }}</h5>
                                    </div>
                                    <div class="logo">
                                        <img src="{{ asset('img/bank/' . $bank->picture) }}" alt="">
                                    </div>
                                    <div class="keterangan">
                                        <p>{{ $bank->bank_account_number }}</p>
                                        <h6>An. {{ $bank->account_name }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- payment -->
        </div>

    @endsection
