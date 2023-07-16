<div class="collapse navbar-collapse" id="navbarSupportedContent">


    @if (Route::has('login'))
        <ul class="navbar-nav ms-auto">

            @auth
                <!-- Right Side Of Navbar -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                @if(auth()->user()->isSuperAdmin())
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{route('superadmin.users.index')}}">Users</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() ? route('admin.videos.index') : route('user.videos.index') }}">Videos</a>
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('login') }}">Log in</a>
                </li>

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            @endauth
        </ul>

    @endif

</div>
