<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aegis Academy | Online Courses, Wiki Pages, Offline Courses - Aegis Academy is started by young educators to provide high - quality education at affordable price. Almost every country conducts several exams to hunt extraordinary problem - solving skilled students.Olympiads are the most prestigious exam among them.</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    @include('includes._mathjax-markdown')
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
                            <a class="no-underline" href="{{ url('/profile') }}">
                                <span class="text-black  hover:text-teal-darker font-semibold text-lg uppercase pr-4">
                                   <i class="fa fa-user mr-2"></i> {{ Auth::user()->name }}
                                </span>
                            </a>

                           <a href="{{ route('logout') }}"
                                class="no-underline hover:text-teal-darker font-semibold text-black uppercase text-lg"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-1"></i>  Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        @auth
        <div class="bg-brand shadow h-16">
        <div class="container mx-auto">
            <div class="flex bg-brand">
                <a href="{{ url('/home') }}"
                   class="{{ request()->is('home*') ? 'bg-brand-darkest' : '' }} no-underline hover:bg-brand-darkest flex-1  px-4 py-3 pt-20 h-16 text-white text-center text-lg tracking-wide font-semibold">
                   <div class="flex w-full justify-center">
                    <img class="" src="{{ asset('/img/home.png') }}" style="width: 25px;height: 100%;">
                    <span class="mt-1 ml-2">Home</span>
                    </div>
                </a>

                <a href="{{ url('/wiki') }}"
                   class="{{ request()->is('wiki*') ? 'bg-brand-darkest' : '' }} no-underline hover:bg-brand-darkest flex-1 pt-20 h-16 text-white text-center text-lg tracking-wide font-semibold px-4 py-4">
                    <div class="flex w-full justify-center">
                    <img class="" src="{{ asset('/img/article.png') }}" style="width: 25px;height: 100%;">
                    <span class="mt-1 ml-2">Wiki</span>
                    </div>
                </a>
                <a href="/courses"
                   class="{{ request()->is('courses*') ? 'bg-brand-darkest' : '' }} no-underline hover:bg-brand-darkest flex-1 pt-20 h-16 text-white text-center text-lg tracking-wide font-semibold px-4 py-4">
                   <div class="flex w-full justify-center">
                    <img class="" src="{{ asset('/img/courses-icon.png') }}" style="width: 25px;height: 100%;">
                    <span class="mt-1 ml-2">Courses</span>
                    </div>
                </a>
                <a href="/practice"
                   class="{{ request()->is('practice*') ? 'bg-brand-darkest' : '' }} no-underline hover:bg-brand-darkest flex-1 pt-20 h-16 text-white text-center text-lg tracking-wide font-semibold px-4 py-4">
                    <div class="flex w-full justify-center">
                    <img class="" src="{{ asset('/img/calc.png') }}" style="width: 25px;height: 100%;">
                    <span class="mt-1 ml-2">Practice</span>
                    </div>
                </a>
                <a href="{{ url('/books') }}"
                    class="{{ request()->is('books*') ? 'bg-brand-darkest' : '' }} no-underline hover:bg-brand-darkest flex-1 pt-20 h-16 text-white text-center text-lg tracking-wide font-semibold px-4 py-4">
                    <div class="flex w-full justify-center">
                    <img class="" src="{{ asset('/img/book.png') }}" style="width: 25px;height: 100%;">
                    <span class="mt-1 ml-2">Books</span>
                    </div>
                </a>
                <a href="{{ url('/discussions') }}"
                   class="{{ request()->is('discussions*') ? 'bg-brand-darkest' : '' }} no-underline hover:bg-brand-darkest flex-1 pt-20 h-16 text-white text-center text-lg tracking-wide font-semibold px-4 py-4">
                    <div class="flex w-full justify-center">
                    <img class="" src="{{ asset('/img/discuss.png') }}" style="width: 25px;height: 100%;">
                    <span class="mt-1 ml-2">Discussions</span>
                    </div>
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
