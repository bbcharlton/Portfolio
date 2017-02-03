<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header pull-left">

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/home') }}">
                {{ config('app.name', 'CMS') }}
            </a>
        </div>

        <div class="pull-right">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="pull-left"><a href="{{ url('/login') }}">Login</a></li>
                    <li class="pull-right"><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->firstname }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                @if (Auth::user()->user_role == 'admin')
                                    <a href="{{url('/admin') }}">
                                        <span class="glyphicon glyphicon-sunglasses"></span> Admin Dashboard
                                    </a>
                                @endif

                                @if (Auth::user()->user_role == 'editor')
                                    <a href="{{url('/posts') }}">
                                        <span class="glyphicon glyphicon-book"></span> Editor Dashboard
                                    </a>
                                @endif

                                <a href="/profile/{{ Auth::user()->firstname }}.{{ Auth::user()->lastname }}/{{ Auth::id() }}">
                                    <span class="glyphicon glyphicon-user"></span> My Profile
                                </a>

                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-off"></span> Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>