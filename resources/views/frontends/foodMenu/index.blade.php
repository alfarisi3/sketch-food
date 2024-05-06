@extends('layouts.appFrontend')

@section('title', 'Food Menu -')

@section('content')
    <div class="foodback">
        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- food-header -->
        <div class="detail-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Foods. <a href="{{ route('drinkMenu.index') }}">Drinks</a>
                            <a href="{{ route('dessertMenu.index') }}">Desserts</a></h1>
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
                    @foreach ($food as $food)
                    <div class="col-lg-12 col-12">
                        <div class="col d-flex justify-content-between">
                            <label for="menu">{!! $food->title !!}</label>
                            <label>{!! $food->price !!}</label>
                        </div>
                        <hr>
                        <p>{!! $food->description !!}</p>
                    </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
    <!-- food -->
@endsection
