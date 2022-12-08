<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Contact') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white position-sticky top-0 " style="z-index: 1000">
            <div class="container-fluid">
                <div class="toggle-icon">
                    <svg focusable="false" viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path></svg>
                </div>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('localImages/contact.png')}}" width="40px" height="40px" alt="">
                    {{ config('app.name', 'Contact') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <div class=" w-75 d-flex align-items-center justify-content-center ms-auto">
                        @if(request('keyword'))
                            <p class="mb-0 me-3">
                                <a href="{{route('contact.index')}}" class="btn btn-sm ">
                                    <i class="bi bi-trash3"></i>
                                </a>
                                Search by : {{request('keyword')}}
                            </p>
                        @endif
                        @yield('search')
                    </div>

                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else


                            <li class="nav-item me-3">
                                <a class="nav-link position-relative" href="{{ route('contact.noti') }} ">
                                    <i class="bi bi-bell fs-3 "></i>
                                    <span class="position-absolute top-0  badge rounded-pill bg-danger" style="right: -4px">
                                        {{\App\Models\StoreContact::where('receiver', Auth::id())->where('isAccepted',0)->count()}}
                                      </span>
                                </a>


                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">

                @guest

                    @yield('content')

                @endguest

                @auth

                   <div class="d-flex mt-0">

                           @include('templates.sideBar')



                           @yield('content')

                   </div>

                @endauth




        </main>


    </div>

    <script>
        window.addEventListener('load',() =>{
            @if(session('status'))
            showToast("{{session('status')}}")
            @endif


        })

    </script>

@stack('script')


</body>
</html>
