<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="shortcut  icon" type="image/x-icon" href="{{ asset('uploads/images/nbcc.ico') }}" media="screen"  />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Student')</title>
   <meta name="description" content="@yield('description', 'ѧ���б�')" /> 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
		{{-- <link href="{{ asset('vendor/geetest/css/gt.css') }}" rel="stylesheet"/> --}}
	@yield('styles')
</head>

<body>
    <div id="app" class="{{ route_class() }}-page">

        @include('layouts._header')

        <div class="container">
            @include('layouts._message')
            @yield('content')

        </div>

        @include('layouts._footer')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	@yield('scripts')
</body>
</html>