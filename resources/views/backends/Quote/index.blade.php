@extends('layouts.appBackend')

@section('title', 'Dashboard')
@section('page-heading', 'Quote')


@section('content')
    <!-- Striped rows start -->
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">

                    {{-- Menampilkan Alert --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {!! session('success') !!} di Sketch Food.
                        </div>
                    @endif



                    <div class="card-body">
                        <div class="row mb-5">

                            {{-- elemen kiri --}}
                            <div class="col-4">
                                <a href="{{ route('quote.create') }}" class="btn btn-primary">Add Quote</a>
                            </div>

                            {{-- elemen kanan --}}
                            <div class="col-md-1">
                                <form method="GET" action="{{ route('quote.index') }}">
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
                                <form method="GET" action="{{ route('quote.index') }}">
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
                                        <th>PEMBAGI</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($quotes as $quote)
                                        <tr>
                                            <td>{{ $loop->iteration + $quotes->perPage() * ($quotes->currentPage() - 1) }}
                                            </td>

                                            <td><img src="{{ asset('img/quote/' . $quote->picture) }}" alt="image"
                                                    class="rounded-square" style="border-radius: 7px" width="80"
                                                    height="100"></td>

                                            <td>{!! $quote->title !!}</td>

                                            <td>{!! $quote->description !!}</td>

                                            <td>{{ $quote->pembagi}}</td>

                                            <td>{{ $quote->status }}</td>


                                            <td>
                                                <a href="{{ route('quote.edit', $quote->id) }}" class="btn btn-warning"><i
                                                        class="bi bi-pencil-square"></i></a>


                                                {{-- Delete with Sweetalert2 --}}
                                                @if ($quote->status != 'show')
                                                    <button class="btn btn-danger"
                                                        onclick="deleteData({{ $quote->id }})"><i
                                                            class="bi bi-trash-fill" style=""></i></button>

                                                    <form id="deleteForm{{ $quote->id }}"
                                                        action="{{ route('quote.destroy', $quote->id) }}" method="POST"
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
                                showing {{ $quotes->firstItem() }} to {{ $quotes->lastItem() }} of {{ $quotes->total() }}
                                entries
                            </div>
                            <div>
                                {{ $quotes->links() }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Striped rows end -->
@endSection


@push('js-quote')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
