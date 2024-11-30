<!-- header top section -->
@if(request()->routeIs('home'))
    <div class="container">
        <div class="header_section_top">
            <div class="row">
                <div class="col-sm-12">
                    <div class="custom_menu">
                        <ul>
                            <li><a href="{{route('seller.showRegisterForm')}}">Are you Supplier?</a></li>
                            <li><a href="{{route('products.index')}}">Show Now</a></li>
                            <li><a href="{{route('terms')}}">Terms and conditions</a></li>
                            <li><a href="{{route('about')}}">About Us</a></li>
                            <li><a href="{{route('contact_us')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- logo section -->
{{--    <div class="logo_section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="logo">--}}
{{--                        --}}{{--                    <a href="{{url('/')}}"><img src="{{ asset('customer/images/logo.png') }}"></a>--}}
{{--                        <h4>Second Bling</h4>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endif

@include('customer.includes.navbar')
