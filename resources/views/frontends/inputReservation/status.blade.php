@extends('layouts.appFrontend')

@section('title', 'Reservation -')

@section('content')
    <div class="reserveback">
        <!-- navbar -->
        @include('layouts.frontends.navbar')
        <!-- navbar -->

        <!-- table -->
        <div class="deskripsi-table">
            <div class="container">
                <div class="tombol">
                    <div class="row">
                        <div class="col-lg-5">
                            <a class="btn btn-outline-light" href="{{ route('inputReservation.input') }}">Reservation</a>
                        </div>
                        <div class="col-lg-5">
                            <a class="btn btn-outline-light" href="{{ route('payment.index') }}">Pembayaran</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table style="background-color: rgba(255, 255, 255, 0.405)55, 255, 255)" class="table">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th>USER</th>
                                <th>DATA</th>
                                <th>RESERVATION</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="table-dark">
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="text-center">{{ $reservation->user->name }}</td>

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
                                            <li><b>Tanggal:</b>{{ dateFormatBack($reservation->date) }}</li>
                                            <li><b>Jam:</b>{{ timeFormatBack($reservation->time) }} WIB</li>
                                            <li><b>Meja:</b>{{ $reservation->table->title }}</li>
                                        </ul>
                                    </td>

                                    <td class="text-center" style="padding-top: 55px">
                                        @if ($reservation->status == 'belum bayar')
                                            <span href="{{ route('reservation.status', $reservation->id) }}"
                                                class="text-warning">belum bayar</span>
                                        @else
                                            <span class="text-success">sudah bayar</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        {{-- jika belum bayar maka tombol delete akan muncul --}}
                                        @if ($reservation->status != 'belum bayar')
                                        @else
                                            {{-- jika sudah bayar maka btton delete tidak muncul --}}
                                            <button class="btn btn-danger"
                                                onclick="deleteData({{ $reservation->id }})"><iconify-icon
                                                    icon="ic:baseline-delete"></iconify-icon></button>

                                            <form id="deleteForm{{ $reservation->id }}"
                                                action="{{ route('inputReservation.destroy', $reservation->id) }}"
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
            </div>
        </div>
        <!-- table -->
    </div>

@endsection

@push('js-reservation')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
