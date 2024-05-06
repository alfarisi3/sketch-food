<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo-black.png') }}" alt="Logo"
                        style="width: 250px; height: 150px;" srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">

            <li class="sidebar-item {{ Route::is('admin.home*') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('hero*') ? 'active' : '' }}">
                <a href="{{ route('hero.index') }}" class='sidebar-link'>
                    <i class="bi bi-image-alt"></i>
                    <span>Hero</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('imagem*') ? 'active' : '' }}">
                <a href="{{ route('imagem.index') }}" class='sidebar-link'>
                    <i class="bi bi-image-alt"></i>
                    <span>Image Menu</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('food*') ? 'active' : '' }}">
                <a href="{{ route('food.index') }}" class='sidebar-link'>
                    <i class="bi bi-egg-fried"></i>
                    <span>Food</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('drink*') ? 'active' : '' }}">
                <a href="{{ route('drink.index') }}" class='sidebar-link'>
                    <i class="bi bi-cup-straw"></i>
                    <span>Drink</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('dessert*') ? 'active' : '' }}">
                <a href="{{ route('dessert.index') }}" class='sidebar-link'>
                    <i class="bi bi-cake2"></i>
                    <span>Desserts</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('quote*') ? 'active' : '' }}">
                <a href="{{ route('quote.index') }}" class='sidebar-link'>
                    <i class="bi bi-book"></i>
                    <span>Quote</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('about*') ? 'active' : '' }}">
                <a href="{{ route('about.index') }}" class='sidebar-link'>
                    <i class="bi bi-journal"></i>
                    <span>About</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('bank*') ? 'active' : '' }}">
                <a href="{{ route('bank.index') }}" class='sidebar-link'>
                    <i class="bi bi-currency-dollar"></i>
                    <span>Bank</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('table*') ? 'active' : '' }}">
                <a href="{{ route('table.index') }}" class='sidebar-link'>
                    <i class="bi bi-phone"></i>
                    <span>Table</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('reservation*') ? 'active' : '' }}">
                <a href="{{ route('reservation.index') }}" class='sidebar-link'>
                    <i class="bi bi-calendar2-date-fill"></i>
                    <span>Reservation</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" onclick="preventDefault();" class='sidebar-link'>
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>

@push('js-sidebar')
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
