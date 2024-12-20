<!DOCTYPE html>
<html>

<head>
    @include('admin.includes.head')
</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->

@include('admin.includes.topbar')
@include('admin.includes.sidebar')
@include('admin.includes.right_sidebar')

<section class="content">
    <div class="container-fluid">
        @yield('content')
    </div>
</section>

@include('admin.includes.footer')
@include('admin.includes.scripts')
</body>

</html>
