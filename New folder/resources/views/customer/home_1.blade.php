<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Bling</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('{{asset('bg.jpeg')}}'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            position: relative;
        }
        .navbar {
            background: transparent !important;
        }
        .navbar-nav .nav-link {
            color: black !important;
            font-weight: 600;
        }
        .main-title {
            font-size: 4rem;
            font-weight: 300;
        }
        .subtitle {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 30px;
        }
        .btn-custom {
            padding: 10px 20px;
            /* border: 1px solid black; */
            font-weight: bold;
            margin: 10px;
            width: 189px !important;
        }
        .btn-shop {
            background-color: black;
            color: white;
        }
        .btn-discover {
            background-color: white;
            color: black;
        }
        .logo {
            width: 130px;
            height: auto;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#"><img src="{{asset('logo.png')}}" alt="Second Bling Logo" class="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{route('seller.showRegisterForm')}}">Seller |</a>  </li>
            <li class="nav-item"><a class="nav-link" href="{{route('customer.registerForm')}}">Buyer  |</a> </li>
            <li class="nav-item"><a class="nav-link" href="{{route('admin.loginForm')}}">Other</a></li>
        </ul>
    </div>
    <div class="ml-auto">
        <a class="nav-link text-dark" href="{{ route('terms') }}">Terms and Conditions</a>
    </div>
</nav>

<!-- Main Content -->
<div class="content-wrapper">
    <h1 class="main-title">SECOND BLING</h1>
    <p class="subtitle">For all things bling, this is your one-stop shop</p>
    <div>
        <a href="{{ route('products.index') }}" class="btn w-100 btn-custom btn-discover">Shop Now</a>
    </div>
    <div>
        <a href="{{route('about')}}" class="btn w-100 btn-custom btn-discover">Discover more</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
