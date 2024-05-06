@extends('layouts.appFrontend')

@section('title', 'Drink Menu -')

@section('content')
    <div class="drinkback">
        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- food-header -->
        <div class="detail-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Drinks. <a href="{{ route('dessertMenu.index') }}">Desserts</a><a href="{{ route('foodMenu.index') }}">Foods</a></h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- food-header -->
    </div>

    <!-- food -->
    <div class="detail-menu">
        <div class="container">
            <div class="section-detail-menu">

                <div class="row">
                    @foreach ($drinks as $drink)
                        <div class="col-lg-12">
                            <div class="col d-flex justify-content-between">
                                <label for="menu">{!! $drink->title !!}</label>
                                <label>{!! $drink->price !!}</label>
                            </div>
                            <hr>
                            <p>{!! $drink->description !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- food -->
@endsection
