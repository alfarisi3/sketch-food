@extends('layouts.appBackend')

@section('title', 'Edit Quote')
@section('page-heading', 'Edit Quote')

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
                <form action="{{ route('quote.update', $quote->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="title"><b>Title</b></label>
                                <input type="text" name="title" id="title"
                                    class="form-control @if ($errors->has('title')) is-invalid @endif"
                                    placeholder="Enter title" value="{{ $quote->title }}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label"><b>Description</b></label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description">{{ $quote->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pembagi"><b>Pembagi</b></label>
                                <fieldset class="form-group">
                                    <select class="form-select" id="pembagi" name="pembagi">
                                        <option selected disabled>Tipe Quote</option>
                                        <option value="{{ $quote->pembagi }}" @if ($quote->pembagi == 'quote 1') selected
                                        @endif>quote 1</option>
                                        <option value="{{ $quote->pembagi }}" @if ($quote->pembagi == 'quote 2') selected
                                            @endif>quote 2</option>
                                    </select>
                                    @error('pembagi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </fieldset>
                            </div>

                            <div class="mb-3">
                                <label for="picture" class="form-label"><b>Input Picture</b></label>
                                <input class="form-control @error('picture') is-invalid @enderror" type="file"
                                    name="picture" id="picture"> <img src="{{ asset('img/quote/' . $quote->picture) }}" alt="{{ $quote->title }}" style="margin-top: 10px; border-radius: 5px;" class="rounded-square" width="80"
                                    height="100">

                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="status" id="status"
                                    @if ($quote->status == 'show') checked @endif>
                                <label class="form-check-label" for="status">Geser untuk menampilkan.</label>
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

@push('js-edit-quote')
    {{-- <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            height: 300,
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template paste textpattern imagetools codesample toc help autoresize emoticons quickbars linkchecker advcode mediaembed image imagetools wordcount textpattern noneditable help charmap emoticons',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            toolbar_mode: 'floating',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script> --}}

    <script src="{{ asset('js/general.js') }}"></script>
@endpush
