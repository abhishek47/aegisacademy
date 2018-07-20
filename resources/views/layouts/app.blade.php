<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Meta Data -->
    @include('includes._meta')

    <!-- Fonts -->
    @include('includes._fonts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @include('includes._mathjax-markdown')

    <!-- Additional Styles For Specific views -->
    @yield('css')

</head>
<body>

    <div id="app">
        
        <!-- Site Navigation Bar -->
        @include('partials._nav')

        <!-- Site Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

    </div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Additional JS For Specific views -->
    @yield('js')
</body>
</html>
