<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
         MyShop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-house"></i>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/collections') }}"><i class="bi bi-list-ul"></i>Categories</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="{{url('search')}}">
                <div class="input-group">
                <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-danger" type="submit">Search</button>
                </div>
              </form>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cart') }}"><h4 class="bi bi-cart-fill"><span class="badge rounded-pill text-bg-danger" style="position: relative;top:-12px;font-size:12px">
                    <livewire:frontend.cart.cart-count/>
                    </span></h4></a>
                </li>
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-person"></i>{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-pen"></i>{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/profile')}}"> <i class="bi bi-person"></i>  Profile</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="{{url('/cart')}}"> <i class="bi bi-cart"></i>  My Cart</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item"> <i class="bi bi-heart"></i>  My Wishlist</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="{{url('/myorders')}}"> <i class="bi bi-list"></i>  My Orders</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="bi bi-arrow-left-circle-fill"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>