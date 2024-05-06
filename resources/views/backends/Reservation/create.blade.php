@extends('layouts.appBackend')

@section('title', 'Add Reservation')
@section('page-heading', 'Add Reservation')


@section('content')
    <section class="section">
        <div class="card">
            {{-- alert --}}
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }} <span class="bold-text">{{ session('boldName') }}</span> di Sketch Food.
                </div>
            @endif
            {{-- alert --}}

            <div class="card-body">
                <form action="{{ route('reservation.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="table_id"><b>Table</b></label>
                                <select class="form-select @error('table_id') is-invalid @enderror" id="table_id"
                                    name="table_id">
                                    <option selected disabled>Select Table</option>
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->id }}">{{ $table->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name"><b>Name</b></label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone"><b>Phone</b></label>
                                <input type="text" name="phone" id="phone"
                                    class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                    placeholder="Enter phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email"><b>Email</b></label>
                                <input type="text" name="email" id="email"
                                    class="form-control @if ($errors->has('email')) is-invalid @endif"
                                    placeholder="Enter email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="date"><b>Tanggal</b></label>
                                <input class="form-control @error('date') is-invalid @enderror" type="date"
                                    name="date" id="date" value="{{ old('date') }}" placeholder="Tanggal"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="time"><b>Jam</b></label>
                                <input class="form-control @error('time') is-invalid @enderror" type="time"
                                    name="time" id="time" value="{{ old('time') }}" placeholder="Jam"
                                    min="{{ \Carbon\Carbon::now()->format('H:i') }}">

                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endSection

@push('js-add-reservation')
    <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            height: 300,
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template paste textpattern imagetools codesample toc help autoresize emoticons quickbars linkchecker advcode mediaembed image imagetools wordcount textpattern noneditable help charmap emoticons',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            toolbar_mode: 'floating',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>

    <script src="{{ asset('js/general.js') }}"></script>
@endpush
