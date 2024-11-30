<!-- header section -->
<div class="header_section">
    <div class="container">

        <div class="containt_main">
            @if(!request()->routeIs('home'))
                <a style="margin-top: -13px;" class="d-flex align-center" href="{{url('/')}}">
                    <img style="height: 70px;" src="{{asset('logo.png')}}">
                </a>
            @endif
                <div style="    z-index: 999999999;" id="mySidenav" class="sidenav">
                    <!-- Logo at the Top -->
{{--                    <div class="sidenav-logo imgSide">--}}
{{--                        <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid">--}}
{{--                    </div>--}}

                    <!-- Close Button -->
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                    <!-- Links with Icons -->
                    <a href="{{ url('/') }}">
                        <i class="fa fa-home"></i> Home
                    </a>
                    <a href="{{ route('products.index') }}">
                        <i class="fa fa-shopping-cart"></i> Products
                    </a>
                    <a href="{{ route('terms') }}">
                        <i class="fa fa-file"></i> Terms
                    </a>
                    <a href="{{ route('about') }}">
                        <i class="fa fa-info-circle"></i> About Us
                    </a>
                    <a href="{{ route('contact_us') }}">
                        <i class="fa fa-envelope"></i> Contact Us
                    </a>
                    <a href="{{ route('customer.trackOrder') }}">
                        <i class="fa fa-map-marker"></i> Track Order
                    </a>

                    @auth('customer')
                        <a href="{{ route('customer.profile') }}">
                            <i class="fa fa-user"></i> My Profile
                        </a>
                        <a href="#" onclick="confirmActionLogout('Are you sure want to logout?', 'logoutFrom')">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                    @endauth
                </div>

                <span class="toggle_icon" onclick="openNav()">
{{--                <img src="{{ asset('customer/images/toggle-icon.png') }}">--}}
                <i style="    color: #68646f;
    font-size: 36px;" class="fa fa-bars"></i>
            </span>
                @if(request()->routeIs('products.index'))
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown">
                    {{ request('category') ? \App\Models\Category::find(request('category'))->category_name : 'All Categories' }}

                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    @foreach(\App\Models\Category::all() as $cat)
                        <a class="dropdown-item" href="{{ route('products.index', ['category' => $cat->category_id]) }}">{{ $cat->category_name }}</a>
                    @endforeach

                </div>
            </div>
                @endif

            <div class="main">
                <form action="{{ route('home') }}" method="GET" class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search for products" value="{{ request('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-secondary btnCustom" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="header_box">

                <div class="login_menu">
                    <ul>
                        @auth('customer')
                            <li>
                                <a class="text-dark" href="{{ route('customer.cart') }}">
                                    <i class="fa  carTT fa-shopping-cart"></i>
                                    <span class="badge cadgCart badge-danger">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                                </a>
                            </li>
                            <li><a class="text-dark" href="{{route('customer.profile')}}"><i class="fa fa-user carTT"></i> <span class="padding_10">Profile</span></a></li>
                            <li><a href="#" class="text-dark" onclick="confirmActionLogout('Are you sure want to logout?', 'logoutFrom')"><i class="fa carTT fa-sign-out"></i> <span class="padding_10">Logout</span></a></li>
                            <form id="logoutFrom" method="post" action="{{route('customer.logout')}}">
                                @csrf
                            </form>
                        @endauth
                        @guest('customer')
                            <li><a class="btn btn-secondary" href="{{route('customer.login')}}"><i class="fa fa-sign-in"></i> <span
                                        class="padding_10">Login</span></a></li>
                            <li><a class="btn btn-secondary" href="{{route('customer.register')}}"><i class="fa fa-sign-in"></i> <span class="padding_10">Register</span></a></li>
                            @endguest
                    </ul>
                </div>
            </div>
        </div>
        @if(request()->routeIs('home'))
       <div class="row d-flex justify-content-center">
           <div class="col-md-12 imgHome">
               <img src="{{asset('customer/images/cover.jpeg')}}">
           </div>

       </div>

        @endif
    </div>
</div>
