<!DOCTYPE html>
<html lang="en">
<head>
    @include('customer.includes.head') <!-- Head Partial -->
</head>
<body>
<!-- Banner Background Section -->
<div class="{{request()->routeIs('home') ? 'banner_bg_main' : 'banner_bg_main2'}}">
    @include('customer.includes.header') <!-- Header Partial -->
    @if(request()->routeIs('home'))
    @include('customer.includes.banner')
    @endif
</div>

@yield('content') <!-- Main Content -->
@yield('modal')
@include('customer.includes.footer') <!-- Footer Partial -->

@include('customer.includes.scripts') <!-- Scripts Partial -->
</body>
</html>
