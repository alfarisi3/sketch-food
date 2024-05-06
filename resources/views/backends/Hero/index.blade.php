@extends('layouts.appBackend')

@section('title', 'Dashboard')
@section('page-heading', 'Hero')


@section('content')
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
                                <a href="{{ route('hero.create') }}" class="btn btn-primary">Add Hero</a>
                            </div>

                            {{-- elemen kanan --}}
                            <div class="col-md-1">
                                <form method="GET" action="{{ route('hero.index') }}">
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
                                <form method="GET" action="{{ route('hero.index') }}">
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
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($heroes as $hero)
                                        <tr>
                                            <td>{{ $loop->iteration + $heroes->perPage() * ($heroes->currentPage() - 1) }}
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <b>1.</b> <img src="{{ asset('img/hero/' . $hero->picture) }}"
                                                            alt="image" class="rounded-square" style="border-radius: 7px"
                                                            width="80" height="100">
                                                    </li>
                                                    <li>
                                                        <b>2.</b> <img src="{{ asset('img/hero/' . $hero->picture_2nd) }}"
                                                            alt="image" class="rounded-square" style="border-radius: 7px"
                                                            width="80" height="100">
                                                    </li>
                                                    <li>
                                                        <b>3.</b> <img src="{{ asset('img/hero/' . $hero->picture_3rd) }}"
                                                            alt="image" class="rounded-square" style="border-radius: 7px"
                                                            width="80" height="100">
                                                    </li>
                                                </ul>
                                            </td>

                                            <td style="max-width: 200px">
                                                <ul>
                                                    <li>{!! $hero->title !!}</li>
                                                    <li>{!! $hero->title_2nd !!}</li>
                                                </ul>
                                            </td>

                                            <td style="max-width: 300px">
                                                <ul>
                                                    <li>{!! $hero->description !!}</li>
                                                    <li>{!! $hero->description_2nd !!}</li>
                                                </ul>
                                            </td>

                                            <td>{{ $hero->status }}</td>
                                            <td>
                                                <a href="{{ route('hero.edit', $hero->id) }}" class="btn btn-warning"><i
                                                        class="bi bi-pencil-square"></i></a>

                                                {{-- Delete with Sweetalert2 --}}
                                                @if ($hero->status != 'show')
                                                    <button class="btn btn-danger"
                                                        onclick="deleteData({{ $hero->id }})"><i
                                                            class="bi bi-trash-fill" style=""></i></button>

                                                    <form id="deleteForm{{ $hero->id }}"
                                                        action="{{ route('hero.destroy', $hero->id) }}" method="POST"
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
                                showing {{ $heroes->firstItem() }} to {{ $heroes->lastItem() }} of {{ $heroes->total() }}
                                entries
                            </div>
                            <div>
                                {{ $heroes->links() }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection




@push('js-hero')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
