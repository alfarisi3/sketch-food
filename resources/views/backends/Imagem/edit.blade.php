@extends('layouts.appBackend')

@section('title', 'Edit Imagem')
@section('page-heading', 'Edit Imagem')

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
                <form action="{{ route('imagem.update', $imagem->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="type"><b>Type</b></label>
                                <fieldset class="form-group">
                                    <select class="form-select" id="type" name="type">
                                        <option selected disabled>Type Menu</option>
                                        <option value="{{ $imagem->type }}" @if ($imagem->type == 'makanan') selected @endif>Food</option>
                                        <option value="{{ $imagem->type }}" @if ($imagem->type == 'minuman') selected @endif>Food</option>>Drink</option>
                                        <option value="{{ $imagem->type }}" @if ($imagem->type == 'cemilan') selected @endif>Food</option>>Dessert</option>
                                    </select>
                                    @error('menu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>

                            <div class="mb-3">
                                <label for="picture" class="form-label"><b>Input Picture</b></label>
                                <input class="form-control @error('picture') is-invalid @enderror" type="file"
                                    name="picture" id="picture"> <img src="{{ asset('img/imagem/' . $imagem->picture) }}" alt="{{ $imagem->id }}" style="margin-top: 10px; border-radius: 5px;" class="rounded-square" width="80" value="{{ $imagem->picture }}">
                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="status" id="status"
                                    @if ($imagem->status == 'show') checked @endif>
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

@push('js-edit-imagem')
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
