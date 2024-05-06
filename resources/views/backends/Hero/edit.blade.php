@extends('layouts.appBackend')

@section('title', 'Add Hero')
@section('page-heading', 'Add Hero')

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
                <form action="{{ route('hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            {{-- title --}}
                            <div class="form-group">
                                <label for="title"><b>Title</b></label>
                                <textarea class="form-control" id="title" name="title" rows="3" placeholder="Enter title">{{ $hero->title }}</textarea>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title_2nd"><b>Title 2</b></label>
                                <textarea class="form-control" id="title_2nd" name="title_2nd" rows="3" placeholder="Enter title">{{ $hero->title_2nd }}</textarea>

                                @error('title_2nd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- title --}}

                        {{-- description --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description" class="form-label"><b>Description</b></label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description">{{ $hero->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description_2nd" class="form-label"><b>Description 2</b></label>
                                <textarea class="form-control" id="description_2nd" name="description_2nd" rows="3"
                                    placeholder="Enter description">{{ $hero->description_2nd }}</textarea>

                                @error('description_2nd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- description --}}

                        {{-- picture --}}
                        <div class="mb-3">
                            <label for="picture" class="form-label"><b>Input Picture</b></label>
                            <input class="form-control @error('picture') is-invalid @enderror" type="file" name="picture"
                                id="picture">
                                <img src="{{ asset('img/hero/' . $hero->picture) }}" alt="{{ $hero->title }}" style="margin-top: 10px; border-radius: 5px;" class="rounded-square" width="80" height="100}}">
                            @error('picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="picture_2nd" class="form-label"><b>Input Picture 2</b></label>
                            <input class="form-control @error('picture_2nd') is-invalid @enderror" type="file"
                                name="picture_2nd" id="picture_2nd">
                                <img src="{{ asset('img/hero/' . $hero->picture_2nd) }}" alt="{{ $hero->title }}" style="margin-top: 10px; border-radius: 5px;" class="rounded-square" width="80" height="100}}">
                            @error('picture_2nd')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="picture_3rd" class="form-label"><b>Input Picture 3</b></label>
                            <input class="form-control @error('picture_3rd') is-invalid @enderror" type="file"
                                name="picture_3rd" id="picture_3rd">
                                <img src="{{ asset('img/hero/' . $hero->picture_3rd) }}" alt="{{ $hero->title }}" style="margin-top: 10px; border-radius: 5px;" class="rounded-square" width="80" height="100}}">
                            @error('picture_3rd')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- picture --}}

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="status" id="status">
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

@push('js-edit-hero')
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
