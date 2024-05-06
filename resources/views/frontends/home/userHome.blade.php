@extends('layouts.appFrontend')

@section('content')
    <!-- Backrground1 -->
    <div class="background1">
        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- hero -->
        <div class="first-hero">
            <div class="container">
                <div class="row">
                    @foreach ($heroes as $hero)
                        <div class="col-lg-7 col-6">
                            <div class="hero">
                                <h1 class="mb-3">{!! $hero->title !!}</h1>
                                <p>{!! $hero->description !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-5 col-6">
                            <img src="{{ asset('img/hero/' . $hero->picture) }}" alt="">
                        </div>
                        <p>Scroll to see more
                            -----------------------------------------------</p>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- hero -->

        <!-- second.hero -->
        <div class="second-hero">
            <div class="container">
                <div class="row">
                    @foreach ($heroes as $hero)
                        <div class="col-lg-7 col-5">
                            <div class="shero1">
                                <h1 class="mb-3">{!! $hero->title_2nd !!}</h1>
                                <img src="{{ asset('img/hero/' . $hero->picture_2nd) }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5 col-7">
                            <div class="shero2">
                                <img src="{{ asset('img/hero/' . $hero->picture_3rd) }}" alt="">
                                <p>{!! $hero->description_2nd !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- second.hero -->
    </div>
    <!-- Backrground1 -->

    <!-- menu -->
    <div class="ourMenu">
        <div class="container">
            <h1><b>Our Menu</b></h1>
            <div class="section-menu">
                <div class="row">
                    @foreach ($food as $food)
                        <div class="col-lg-12 col-12">
                            <div class="col d-flex justify-content-between">
                                <label>{!! $food->title !!}</label>
                                <label>Rp. {!! $food->price !!}</label>
                            </div>
                            <hr>
                            <p>{!! $food->description !!}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- menu -->

    <!-- kata mutiara -->
    <div class="kata-mutiara">
        @foreach ($quotes as $quote)
            @if ($quote->pembagi == 'quote 2')
                <div class="mutiara1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <img src="{{ asset('img/quote/' . $quote->picture) }}" alt="">
                            </div>

                            <div class="col-lg-8 col-6">
                                <p>{!! $quote->description !!}</p>
                                <h4>{{ $quote->title }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($quote->pembagi == 'quote 1')
                <div class="mutiara2">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-6">
                                <p>{!! $quote->description !!}</p>
                                <h4>{{ $quote->title }}</h4>
                            </div>

                            <div class="col-lg-4 col-6">
                                <img src="{{ asset('img/quote/' . $quote->picture) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <!-- kata mutiara -->

    <!-- reservasi -->
    <div class="reservasi">
        <div class="container">
            <div class="row">
                <h1><b>Reservation</b></h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Lorem ipsum dolor sit amet consectetur.</p>
                <a class="btn btn-outline-dark" href="{{ route('inputReservation.input') }}">Reservation</a>
            </div>
        </div>
    </div>
    <!-- reservasi -->
@endsection
