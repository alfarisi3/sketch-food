@extends('layouts.appFrontend')

@section('title', 'Menu -')

@section('content')
    <!-- with background -->
    <div class="listmenuback">
        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- list menu -->
        <div class="list-menu">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>List menu <br>
                            <x style="margin-left: 100px;">untuk Anda.</x>
                        </h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- list menu -->
    </div>
    <!-- with background -->

    <!-- Menu -->
    <div class="menu">
        @foreach ($imagems as $imagem)
            @if ($imagem->type == 'makanan')
                <!-- food -->
                <div class="food">
                    <div class="container">
                        <div class="section-food">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h1><b>Foods</b></h1>
                                    <img src="{{ asset('img/imagem/' . $imagem->picture) }}" alt="">
                                </div>
                                <div class="col-lg-6">
                                    <div class="list">
                                        <div class="row">
                                            @foreach ($food as $food)
                                                <div class="col-lg-12">
                                                    <div class="col d-flex justify-content-between">
                                                        <label for="menu">{!! $food->title !!}</label>
                                                        <label>Rp. {!! $food->price !!}</label>
                                                    </div>
                                                    <hr>
                                                    <p>{!! $food->description !!}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="more" href="{{ route('foodMenu.index') }}">Lihat lainnya >></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- food -->
            @elseif ($imagem->type == 'minuman')
                <!-- drink -->
                <div class="drink">
                    <div class="container">
                        <div class="section-drink">
                            <div class="row">
                                <h1><b>Drinks</b></h1>
                                <div class="col-lg-6 col-6">
                                    <div class="list">
                                        <div class="row">
                                            @foreach ($drinks as $drink)
                                                <div class="col-lg-12">
                                                    <div class="col d-flex justify-content-between">
                                                        <label for="menu">{!! $drink->title !!}</label>
                                                        <label>Rp. {!! $drink->price !!}</label>
                                                    </div>
                                                    <hr>
                                                    <p>{!! $drink->description !!}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="more" href="{{ route('drinkMenu.index') }}">Lihat lainnya >></a>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-5">
                                    <img src="{{ asset('img/imagem/' . $imagem->picture) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- drink -->
            @elseif ($imagem->type == 'cemilan')
                <!-- dessert -->
                <div class="dessert">
                    <div class="container">
                        <div class="section-dessert">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h1><b>Desserts</b></h1>
                                    <img src="{{ asset('img/imagem/' . $imagem->picture) }}" alt="">
                                </div>
                                <div class="col-lg-6">
                                    <div class="list">
                                        <div class="row">
                                            @foreach ($desserts as $dessert)
                                                <div class="col-lg-12">
                                                    <div class="col d-flex justify-content-between">
                                                        <label for="menu">{!! $dessert->title !!}</label>
                                                        <label>Rp. {!! $dessert->price !!}</label>
                                                    </div>
                                                    <hr>
                                                    <p>{!! $dessert->description !!}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="more" href="{{ route('dessertMenu.index') }}">Lihat lainnya >></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- dessert -->
            @endif
        @endforeach
    </div>
    <!-- Menu -->
@endsection
