<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div>
            <a class="navbar-brand brand-logo" href="{{route('home')}}">
                Market-inzight
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                @auth
                    <h1 class="welcome-text"> <span class="text-black fw-bold">
                            Welcome
                            </span></h1>
                    <h3 class="welcome-sub-text">Your performance summary this week </h3>
                @else
                    <h1 class="welcome-text">Log in to start your management </h1>
                @endauth

            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item d-none d-lg-block">
                    <a href="{{route('logout')}}" type="button" class="btn btn-danger">
                        Logout
                    </a>
                </li>
            @else
                <li class="nav-item d-none d-lg-block">
                    <a href="{{route('login')}}" type="button" class="btn btn-primary">
                        Login
                    </a>
                </li>
            @endauth
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>

            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{asset('images/faces/face8.jpg')}}"
                         alt="Profile image"> </a>
            </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

