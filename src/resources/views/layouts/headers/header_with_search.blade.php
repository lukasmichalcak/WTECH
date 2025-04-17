<header>
    <nav class="navbar prometex-color navbar-expand-lg">
        <div class="container-fluid">
            @if (request()->routeIs('home'))
                <div class="navbar-brand">Prometex</div>
            @else
                <a class="navbar-brand" href="{{ route('home') }}">Prometex</a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-supported-content" aria-controls="navbar-supported-content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse" id="navbar-supported-content">

                <!-- Search Bar (Properly Responsive) -->
                <div class="search-container d-flex mx-auto">

                    <!-- Search Form -->
                    <form class="d-flex search-form">
                        <input class="form-control me-2 search-input" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light my-0 navbar-button" type="submit">Search</button>
                    </form>
                </div>

                <div class="justify-items-center align-items-center d-flex">
                    @auth
                        <div class="dropdown me-3">
                            <a class="nav-link navbar-icons d-inline-block  fs-4" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person-circle me-1"></i>My Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('orders') }}"><i class="bi bi-list-task me-1"></i>Order History</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left me-1"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>


                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-light navbar-button me-3">Login</a>
                    @endguest

                    <a class="nav-link navbar-icons d-inline-block position-relative me-3" href="shopping-cart.html">
                        <i class="bi bi-cart fs-4"></i>
                        @if($cartItemsCount > 0)
                            <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle
                        badge rounded-pill bg-danger cart-badge">{{ $cartItemsCount }}</span>
                        @endif
                    </a>
                </div>
            </div>

        </div>
    </nav>
</header>
