@extends('layouts.appBackend')

@section('title', 'Dashboard')
@section('page-heading', 'Desserts')


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
                                <a href="{{ route('dessert.create') }}" class="btn btn-primary">Add Dessert</a>
                            </div>

                            {{-- elemen kanan --}}
                            <div class="col-md-1">
                                <form method="GET" action="{{ route('dessert.index') }}">
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
                                <form method="GET" action="{{ route('dessert.index') }}">
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
                                    @foreach ($desserts as $dessert)
                                        <tr>
                                            <td>{{ $loop->iteration + $desserts->perPage() * ($desserts->currentPage() - 1) }}
                                            </td>

                                            <td><img src="{{ asset('img/dessert/' . $dessert->picture) }}" alt="image"
                                                    class="rounded-square" style="border-radius: 7px" width="80"
                                                    height="100"></td>

                                            <td>{!! $dessert->title !!}</td>

                                            <td>{!! $dessert->description !!}</td>

                                            <td>{{ $dessert->price }}</td>

                                            <td>{{ $dessert->status }}</td>

                                            <td>
                                                <a href="{{ route('dessert.edit', $dessert->id) }}"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                                @if ($dessert->status != 'show')
                                                    <button class="btn btn-danger"
                                                        onclick="deleteData({{ $dessert->id }})"><i
                                                            class="bi bi-trash-fill" style=""></i></button>

                                                    <form id="deleteForm{{ $dessert->id }}"
                                                        action="{{ route('dessert.destroy', $dessert->id) }}" method="POST"
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
                                showing {{ $desserts->firstItem() }} to {{ $desserts->lastItem() }} of
                                {{ $desserts->total() }}
                                entries
                            </div>
                            <div>
                                {{ $desserts->links() }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Striped rows end -->
@endSection


@push('js-dessert')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
