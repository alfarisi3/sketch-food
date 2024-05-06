
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Sketch Food</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.frontends.styles')

</head>

<body>
    <!-- content -->
   @yield('content')
    <!-- content -->

    <!-- footer Sfd -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <hr>
                <div class="col-lg-4 col-6">
                    <img src="{{ asset('sketch-food/assets/logo-black.png') }}" alt="">
                </div>

                <div class="col-lg-4 col-6">
                    <div class="section-akun">
                        <a href=""><img src="{{ asset('sketch-food/assets/instagram.png') }}" alt=""></a>
                        <a href=""><img src="{{ asset('sketch-food/assets/facebook.png') }}" alt=""></a>
                        <a href=""><img src="{{ asset('sketch-food/assets/twitter.png') }}" alt=""></a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <p><iconify-icon icon="ic:baseline-phone"></iconify-icon>0088899898</p>
                    <p><iconify-icon icon="material-symbols:mail"></iconify-icon>skechfd@gmail.com</p>
                    <p><iconify-icon icon="mdi:location"></iconify-icon>Jalan makanan sehat, No. 450</p>
                </div>
                <hr>
                <h6>&copy; copyright, Sketch Food 2024</h6>
            </div>
        </div>
    </div>
    <!-- footer Sfd -->

    @include('layouts.frontends.scripts')






</body>

</html>
