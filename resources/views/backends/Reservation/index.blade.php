@extends('layouts.appBackend')

@section('title', 'Reservation')
@section('page-heading', 'Reservation')


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
                                <a href="{{ route('reservation.create') }}" class="btn btn-primary">Add Reservation</a>
                            </div>

                            {{-- elemen kanan --}}
                            <div class="col-md-1">
                                <form method="GET" action="{{ route('reservation.index') }}">
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
                                <form method="GET" action="{{ route('reservation.index') }}">
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
                                        <th>USER</th>
                                        <th>DATA</th>
                                        <th>RESERVATION</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>

                                            <td>{{ $loop->iteration + $reservations->perPage() * ($reservations->currentPage() - 1) }}
                                            </td>

                                            <td>{{ $reservation->user->name }}</td>

                                            <td style="max-width: 200px">
                                                <ul>
                                                    <li><b>Name:</b>{{ $reservation->name }}</li>
                                                    <li><b>Phone:</b>{{ $reservation->phone }}</li>
                                                    <li><b>Email:</b>{{ $reservation->email }}</li>
                                                </ul>
                                            </td>

                                            <td style="max-width: 200px">
                                                <ul>
                                                    <li><b>Tanggal Pemesan:</b>{{ dateFormat($reservation->created_at) }} WIB</li>
                                                    <li><b>Tanggal:</b>{{ dateFormatBack($reservation->date)}}</li>
                                                    <li><b>Jam:</b>{{ timeFormatBack($reservation->time)}} WIB</li>
                                                    <li><b>Meja:</b>{{ $reservation->table->title }}</li>
                                                </ul>
                                            </td>


                                            <td>
                                                @if ($reservation->status == 'belum bayar')
                                                <a href="{{ route('reservation.status', $reservation->id) }}"
                                                    class="btn btn-warning">belum bayar</a>
                                                @else
                                                    <span class="badge bg-success">sudah bayar</span>
                                                @endif
                                            </td>

                                            <td>
                                                {{-- Delete with Sweetalert2 --}}
                                                @if ($reservation->status != 'sudah bayar')
                                                    <button class="btn btn-danger"
                                                        onclick="deleteData({{ $reservation->id }})"><i
                                                            class="bi bi-trash-fill" style=""></i></button>

                                                    <form id="deleteForm{{ $reservation->id }}"
                                                        action="{{ route('reservation.destroy', $reservation->id) }}"
                                                        method="POST" class="d-inline">
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
                                showing {{ $reservations->firstItem() }} to {{ $reservations->lastItem() }} of
                                {{ $reservations->total() }}
                                entries
                            </div>
                            <div>
                                {{ $reservations->links() }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection




@push('js-reservation')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
