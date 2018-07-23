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
        <nav class="bg-white h-14 shadow mb-35 p-4 md:px-0" >
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
                            <span class="text-grey-darker text-sm pr-4">{{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                                class="no-underline hover:underline text-grey-darker text-sm"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')


        <footer class="h-12 bg-black p-2 py-4">
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
