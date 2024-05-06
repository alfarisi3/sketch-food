@extends('layouts.appBackend')

@section('title', 'Dashboard')
@section('page-heading', 'Food')


@section('content')
    <!-- Striped rows start -->
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">

                    {{-- Menampilkan Alert --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }} <span class="bold-text">{{ session('boldName') }}</span> di Sketch Food.
                        </div>
                    @endif



                    <div class="card-body">
                        <div class="row mb-5">

                            {{-- elemen kiri --}}
                            <div class="col-4">
                                <a href="{{ route('food.create') }}" class="btn btn-primary">Add Food</a>
                            </div>

                            {{-- elemen kanan --}}
                            <div class="col-md-1">
                                <form method="GET" action="{{ route('food.index') }}">
                                    <fieldset class="form-group">
                                        <select class="form-select" name="pagination" id="paginaton"
                                            onchange="this.form.submit()">
                                            <option value="10" {{ $pagination == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ $pagination == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ $pagination == 50 ? 'selected' : '' }}>50</option>
                                            <option value="100" {{ $pagination == 100 ? 'selected' : '' }}>100</option>
                                        </select>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('food.index') }}">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" name="search" id="search"
                                            value="{{ $search }}" placeholder="search keyword..."
                                            aria-label="search keyword" aria-describedby="basic-addon2">
                                        <button class="btn btn-success" type="submit" id="basic-addon2">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- table striped -->
                        <div class="">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>PICTURE</th>
                                        <th>TITLE</th>
                                        <th>DESCRIPTION</th>
                                        <th>PRICE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($foods as $food)
                                        <tr>
                                            <td>{{ $loop->iteration + $foods->perPage() * ($foods->currentPage() - 1) }}
                                            </td>

                                            <td><img src="{{ asset('img/food/' . $food->picture) }}" alt="image"
                                                    class="rounded-square" style="border-radius: 7px" width="80"
                                                    height="100"></td>

                                            <td>{!! $food->title !!}</td>

                                            <td>{!! $food->description !!}</td>

                                            <td>{{ $food->price }}</td>

                                            <td>{{ $food->status }}</td>

                                            <td>
                                                <a href="{{ route('food.edit', $food->id) }}" class="btn btn-warning"><i
                                                        class="bi bi-pencil-square"></i></a>


                                                {{-- Delete with Sweetalert2 --}}
                                                @if ($food->status != 'show')
                                                    <button class="btn btn-danger"
                                                        onclick="deleteData({{ $food->id }})"><i
                                                            class="bi bi-trash-fill" style=""></i></button>

                                                    <form id="deleteForm{{ $food->id }}"
                                                        action="{{ route('food.destroy', $food->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="col-12 d-flex justify-content-between mt-3">
                            <div>
                                showing {{ $foods->firstItem() }} to {{ $foods->lastItem() }} of {{ $foods->total() }}
                                entries
                            </div>
                            <div>
                                {{ $foods->links() }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Striped rows end -->
@endSection


@push('js-food')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush