<!DOCTYPE html>
<html lang="de">
<head>
    @include('layout.partials.head')
</head>
<body>
@include('layout.partials.nav')
@include('layout.partials.header')

<div class="container">

    @yield('content')

</div>


@include('layout.partials.footer')
@include('layout.partials.footer-scripts')
 </body>
</html>
