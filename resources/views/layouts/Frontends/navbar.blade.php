@guest
    {{-- guest --}}
    {{-- <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('sketch-food/assets/logo-white.png') }}"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('home.page') }}">Home</a>
                    <a class="nav-link" href="{{ route('menu.index') }}">Menu</a>
                    <a class="nav-link" href="{{ route('aboutPage.index') }}">About</a>
                    <a class="nav-link" href="{{ route('inputReservation.status') }}">Reservation</a>
                    <div class="btn-group" role="group">
                        @if (Route::is('login'))
                            <a class="btn btn-outline-light" href="{{ route('register') }}">Register</a>
                        @elseif (Route::is('register'))
                            <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                        @else
                            <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav> --}}

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('sketch-food/assets/logo-white.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span  class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('home.page') }}">Home</a>
                    <a class="nav-link" href="{{ route('menu.index') }}">Menu</a>
                    <a class="nav-link" href="{{ route('aboutPage.index') }}">About</a>
                    <a class="nav-link" href="{{ route('inputReservation.status') }}">Reservation</a>
                    <div class="btn-group" role="group">
                        @if (Route::is('login'))
                            <a class="btn btn-outline-light" href="{{ route('register') }}">Register</a>
                        @elseif (Route::is('register'))
                            <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                        @else
                            <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{-- guest --}}
@else
    @if (Auth::user()->role == 'admin')
        {{-- Admin --}}
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.home') }}"><img
                        src="{{ asset('sketch-food/assets/logo-white.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <a class="btn btn-outline-light" style="margin-left: 750px" href="{{ route('admin.home') }}">Dasbhoard</a>
                </div>
            </div>
        </nav>
        {{-- Admin --}}
    @else
        {{-- User --}}
        <nav id="logged" class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img
                        src="{{ asset('sketch-food/assets/logo-white.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                        <a class="nav-link" href="{{ route('menu.index') }}">Menu</a>
                        <a class="nav-link" href="{{ route('aboutPage.index') }}">About</a>
                        <a class="nav-link" href="{{ route('inputReservation.status') }}">Reservation</a>

                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @if (Auth::user()->picture)
                                    <img src="{{ asset('storage/users/' . Auth::user()->picture) }}" alt="Profile Picture"
                                        class="rounded-circle" style="width: 30px; height: 30px;">
                                @else
                                    <img src="https://picsum.photos/200" alt="Profile Picture" class="rounded-circle"
                                        style="width: 30px; height: 30px;">
                                @endif
                                <h5>{{ Auth::user()->name }}</h5>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" onclick="preventDefault();" class="dropdown-item"><span style="color: white">Logout</span></a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        {{-- User --}}
    @endif
@endguest

@push('js-navbar')
    <script>
        function preventDefault() {
            Swal.fire({
                title: "Anda yakin ingin logout?",
                text: "Jika logout, anda harus login kembali!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, logout!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });

        }
    </script>
@endpush

