<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">MWS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">


            @auth('user')
                <li class="nav-item {{ Request::is('user.dashboard') ? 'active' : '' }}" title="Dashboard">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item {{ Request::is('events') ? 'active' : '' }}" title="events">
                    <a class="nav-link" href="{!! url('events') !!}">&nbsp;Events</a>
                </li>

            @elseauth('admin')

                <li class="nav-item {{ Request::is('admin.dashboard') ? 'active' : '' }}" title="Admin Dashboard">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                </li>
                <li class="nav-item {{ Request::is('/auth/register/') ? 'active' : '' }}" title="register">
                    <a class="nav-link" href="{{ route('user.auth.register') }}">&nbsp;Registrierung</a>
                </li>

                <li class="nav-item {{ Request::is('/auth/admin-register/') ? 'active' : '' }}" title="register">
                    <a class="nav-link" href="{{ route('admin.register.get') }}">&nbsp;Admin-Registrierung</a>
                </li>

             @else
                <li class="nav-item {{ Request::is('guest') ? 'active' : '' }}" title="Guest">
                    <a class="nav-link" href="{!! url('guest') !!}">&nbsp;Guest</a>
                </li>
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}" title="Start">
                    <a class="nav-link" href="{!! url('') !!}">&nbsp;Start</a>
                </li>

                <li class="nav-item {{ Request::is('/auth/user-login') ? 'active' : '' }}" title="Login">
                    <a class="nav-link" href="{{route('user.auth.login') }}">&nbsp;Login</a>
                </li>

                <li class="nav-item {{ Request::is('/auth/admin-login') ? 'active' : '' }}" title="Admin-Login">
                    <a class="nav-link" href="{{ route('admin.auth.login') }}">&nbsp;Admin-Login</a>
                </li>

            @endauth

                {{-- <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                   Dropdown
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <a class="dropdown-item" href="#">Action</a>
                   <a class="dropdown-item" href="#">Another action</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">Something else here</a>
               </div>
           </li>--}}


        </ul>
        <ul class="navbar-nav ml-auto">

            @auth('user')
                <li class="nav-item list-unstyled">
                    <a  class="nav-link text-muted">
                        Eingeloggt als User &nbsp; |
                    </a>
                </li>

                <li class="nav-item {{ Request::is('/logout/') ? 'active' : '' }}" title="logout">
                    <a class="nav-link" href="{{ route('user.logout') }}">&nbsp;Logout</a>
                </li>


            @elseauth('admin')
                <li class="nav-item list-unstyled">
                    <a class="nav-link text-muted">
                        Eingeloggt als Admin &nbsp; |
                    </a>
                </li>

                <li class="nav-item {{ Request::is('/admin-logout/') ? 'active' : '' }}" title="logout">
                    <a class="nav-link" href="{{ route('admin.logout') }}">&nbsp;Logout</a>
                </li>
            @else

                <li class="nav-item list-unstyled">
                    <a class="nav-link text-muted">
                        Nicht eingeloggt
                    </a>
                </li>

            @endauth

        </ul>
        {{-- <form class="form-inline my-2 my-lg-0">
             <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
         </form>--}}
    </div>
</nav>
