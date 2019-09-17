<!DOCTYPE html>
<html lang="de">
<head>
    @include('layout.partials.head')
</head>
<body>
<div id="app">
@include('layout.partials.nav')
@include('layout.partials.header')



@yield('content')




@include('layout.partials.footer')
@include('layout.partials.footer-scripts')

</div>

<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')


 </body>
</html>
