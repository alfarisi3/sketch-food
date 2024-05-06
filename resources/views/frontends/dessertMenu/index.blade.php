@extends('layouts.appFrontend')

@section('title', 'Dessert Menu -')

@section('content')
    <div class="dessertback">
        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- food-header -->
        <div class="detail-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Desserts. <a href="{{ route('foodMenu.index') }}">Foods</a><a href="{{ route('drinkMenu.index') }}">Drinks</a></h1>
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
                    @foreach ($dessert as $dessert)
                        <div class="col-lg-12">
                            <div class="col d-flex justify-content-between">
                                <label for="menu">{!! $dessert->title !!}</label>
                                <label>{!! $dessert->price !!}</label>
                            </div>
                            <hr>
                            <p>{!! $dessert->description !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- food -->
@endsection
