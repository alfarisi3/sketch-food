@extends('layouts.appBackend')

@section('title', 'Edit Table')
@section('page-heading', 'Edit Table')

@section('content')
    <section class="section">
        <div class="col-12">
            <div class="card">
                {{-- alert --}}
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }} <span class="bold-text">{{ session('boldName') }}</span> di Sketch Food.
                    </div>
                @endif
                {{-- alert --}}

                <div class="card-body">
                    <form action="{{ route('table.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="title"><b>Title</b></label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @if ($errors->has('title')) is-invalid @endif"
                                        placeholder="Enter title" value="{{ $table->title }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label"><b>Description</b></label>
                                <textarea class="form-control @error('description')
                                    is-invalid
                                @enderror" id="description" name="description" rows="3" placeholder="Enter description">{{ $table->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="total_meja"><b>Total meja</b></label>
                                    <input type="number" name="total_meja" id="total_meja"
                                        class="form-control @if ($errors->has('total_meja')) is-invalid @endif"
                                        placeholder="Enter total meja" value="{{ $table->total_meja }}">
                                    @error('total_meja')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endSection

@push('js-edit-table')
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
