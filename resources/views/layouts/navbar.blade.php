 <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('/assets/images/logo.png') }}" alt="Web Bus" width="60">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{ url('/')}}" class="nav-link" >Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/book-ticket')}}" class="nav-link" >Book ticket</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/contact')}}" class="nav-link" >Contact us</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto nav-pills">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item mr-2">
                                <a class="nav-link active text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link active text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item mr-3">
                                <a class="nav-link" href="{{ url('profile/reports') }}">
                                    {{ __('My Transaction') }}
                                </a>
                            </li>

                            @if (Auth::user()->role->id == 2)
                                <li class="nav-item mr-3">
                                    <a class="nav-link" href="{{ url('admin/cancellation') }}">
                                        {{ __('Cancellation Request') }}
                                    </a>
                                </li>

                                <li class="nav-item mr-3">
                                  <a class="nav-link" href="{{ url('admin/busses') }}">
                                        {{ __('My Busses') }}
                                    </a>
                                </li>


                            @elseif (Auth::user()->role->id == 1)
                                <li class="nav-item mr-3">
                                  <a class="nav-link" href="{{ url('superadmin/busses') }}">
                                        {{ __('All Busses') }}
                                    </a>
                                </li>

                                <li class="nav-item mr-3">
                                  <a class="nav-link" href="{{ url('superadmin/users') }}">
                                        {{ __('All Users') }}
                                    </a>
                                </li>

                            @endif


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle bg-transparent" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">

                                     <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('My Profile') }}
                                    </a>


                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
