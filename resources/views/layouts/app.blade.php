<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white h-screen">
    <div id="app">
        <nav class="bg-white h-14 shadow p-4 md:px-0" >
            <div class="container mx-auto h-full">
                <div class="flex items-center justify-between h-12">
                    <div class="flex-1">
                        <a href="{{ url('/') }}" class="no-underline">
                            <img class="mt-1" src="{{ asset('/img/logo.png') }}" style="width: 300px;">
                        </a>
                    </div>

                    <div class="flex-3 text-right">
                        @guest
                            <a href="{{ url('/login') }}" class="no-underline  bg-orange hover:bg-orange-dark text-white font-semibold hover:text-white py-3 px-6 border hover:border-transparent rounded mr-4">
                              Sign In
                            </a>
                             <a href="{{ url('/register') }}" class="no-underline bg-transparent hover:bg-brand text-brand-dark font-semibold hover:text-white py-3 px-6 border border-brand hover:border-transparent rounded">
                              Sign Up
                            </a>
                        @else
                            <a class="no-underline" href="#">
                                <span class="text-black  hover:text-teal font-semibold text-xl uppercase pr-4">
                                   <i class="fa fa-user mr-2"></i> {{ Auth::user()->name }}
                                   <i class="fa fa-chevron-down"></i>
                                </span>
                            </a>

                         {{--    <a href="{{ route('logout') }}"
                                class="no-underline hover:text-brand text-grey-darkest uppercase text-xl"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form> --}}
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        @auth
        <div class="bg-grey-darker shadow h-16">
        <div class="container mx-auto">
            <div class="flex bg-grey-darker">
                <a href="{{ url('/home') }}"
                   class="{{ request()->is('home*') ? 'bg-grey-darkest' : '' }} no-underline hover:bg-grey-darkest flex-1 pt-20 h-16 text-white text-center text-xl tracking-wide font-semibold px-4 py-4">
                    <i class="fa fa-home"></i> Home
                </a>

                <a href="{{ url('/wiki') }}"
                   class="{{ request()->is('wiki*') ? 'bg-grey-darkest' : '' }} no-underline hover:bg-grey-darkest flex-1 pt-20 h-16 text-white text-center text-xl tracking-wide font-semibold px-4 py-4">
                    <i class="far fa-file-alt"></i> Wiki
                </a>
                <a href="#"
                   class="{{ request()->is('courses*') ? 'bg-grey-darkest' : '' }} no-underline hover:bg-grey-darkest flex-1 pt-20 h-16 text-white text-center text-xl tracking-wide font-semibold px-4 py-4">
                    <i class="fa fa-video"></i> Courses
                </a>
                <a href="#"
                   class="{{ request()->is('practice*') ? 'bg-grey-darkest' : '' }} no-underline hover:bg-grey-darkest flex-1 pt-20 h-16 text-white text-center text-xl tracking-wide font-semibold px-4 py-4">
                    <i class="fa fa-question"></i> Practice
                </a>
                <a href="#"
                    class="{{ request()->is('books*') ? 'bg-grey-darkest' : '' }} no-underline hover:bg-grey-darkest flex-1 pt-20 h-16 text-white text-center text-xl tracking-wide font-semibold px-4 py-4">
                    <i class="fa fa-book"></i> Books
                </a>
                <a href="#"
                   class="{{ request()->is('discussions*') ? 'bg-grey-darkest' : '' }} no-underline hover:bg-grey-darkest flex-1 pt-20 h-16 text-white text-center text-xl tracking-wide font-semibold px-4 py-4">
                    <i class="fa fa-comments"></i> Discussions
                </a>
            </div>
        </div>
    </div>
    @endauth

        @yield('content')


        <footer class="h-12 bg-black p-2 py-4 relative w-full pin-b">
            <div class="container mx-auto">
                <div class="flex">
                    <span class="flex-1 text-semibold text-white">&copy; Copyright 2018. Powered by <a href="#" class="text-white font-semibold no-underline hover:underline">Trumpets</a></span>
                    <span class="text-semibold white">
                        <a href="#" class="text-white no-underline hover:underline mr-6">Invest</a>
                        <a href="#" class="text-white no-underline hover:underline mr-6">Terms</a>
                        <a href="#" class="text-white no-underline hover:underline mr-6">Contact</a></span>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
