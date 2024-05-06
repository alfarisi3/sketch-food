@extends('layouts.appFrontend')

@section('title', 'About -')

@section('content')

    <!-- with background -->
    <div class="aboutback">

        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- tentang -->
        <div class="about-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Tentang <br>
                            <x style="margin-left: 100px;">Sketch Food.</x>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- tentang -->
    </div>
    <!-- with background -->

    <!-- about  -->
    <div class="about">
        <!-- deskripsi -->
        @foreach ($abouts as $about)
        <div class="deskripsi-about">
            <div class="container">
                <div class="section-about">
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <p>{!! $about->description !!}</p>
                        </div>
                        <div class="col-lg-6 col-6">
                            <img src="{{ asset('img/about/' . $about->picture) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- deskripsi -->

        <!-- deskripsi -->
        <div class="deskripsi-location">
            <div class="container">
                <div class="section-location">
                    <div class="row">
                        <div class="col-lg-5 col-5">
                            <img src="{{ asset('img/about/' . $about->picture) }}" alt="">
                        </div>
                        <div class="col-lg-6 col-6">
                            <p>{!! $about->description !!}</p>
                            <a class="btn btn-outline-dark" target="_blank"
                                href="https://www.google.com/maps/place/Palembang,+Kota+Palembang,+Sumatera+Selatan/@-2.9547941,104.6805616,12z/data=!3m1!4b1!4m6!3m5!1s0x2e3b75e8fc27a3e3:0x3039d80b220d0c0!8m2!3d-2.9760735!4d104.7754307!16zL20vMDFjXzky?entry=ttu">In
                                Google Map</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- deskripsi -->
    </div>
    <!-- about -->
@endsection
