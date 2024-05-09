<div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{('../assets/images/logo-removebg-preview.png')}}" height="46px" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
                <li class="nav-item px-3">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">Dashboard</a>
                </li>
              
            </ul>
            <ul class="list-unstyled mt-md-3">
                <li class="nav-item dropdown me-auto">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                       
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="dropdown-item">Sign Out</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

</div>