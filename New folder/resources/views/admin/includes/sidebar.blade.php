<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img height="70px" src="{{ asset('logo.png') }}">
        </div>

        <div class="info-container">
            @auth('admin')
                <div class="name text-dark" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">    <i class="material-icons">person</i> Welcome : {{auth('admin')->user()->username}}</div>
{{--                <div class="email text-dark">{{auth('admin')->user()->email}}</div>--}}
            @endauth
            @auth('seller')
                <div class="name text-dark" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false"> <i class="material-icons">person</i> Welcome : {{auth('seller')->user()->fullName}}</div>
{{--                <div class="email text-dark">{{auth('seller')->user()->email}}</div>--}}
            @endauth
        </div>
    </div>

    <!-- Menu -->
    <div class="menu">
        @auth('admin')
            <ul class="list">
                <li class="{{request()->is('admin/home') || request()->is('admin/profile') ? 'active' : ''}}">
                    <a href="{{route('admin.home')}}">
                        <i class="material-icons">home</i>
                        <span>Control Board</span>
                    </a>
                </li>
                @if(auth('admin')->user()->role == 'super_admin')
                <li class="{{request()->is('admin/admins*') ? 'active' : ''}}">
                    <a href="{{route('admin.admins.index')}}">
                        <i class="material-icons">person</i>
                        <span>Admins</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/authenticators*') ? 'active' : ''}}">
                    <a href="{{route('admin.authenticators.index')}}">
                        <i class="material-icons">verified_user</i>
                        <span>Authenticators</span>
                    </a>
                </li>
                @endif
{{--                <li class="{{request()->is('admin/products-check*') ? 'active' : ''}}">--}}
{{--                    <a href="{{route('admin.products_check.index')}}">--}}
{{--                        <i class="material-icons">verified_user</i>--}}
{{--                        <span>Check Products</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="{{request()->is('seller/deals*') ? 'active' : ''}}">
                    <a href="{{route('admin.deals.index')}}">
                        <i class="material-icons">border_color</i>
                        <span> Deals</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/products') ? 'active' : ''}}">
                    <a href="{{route('admin.products.index')}}">
                        <i class="material-icons">shopping_basket</i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/categories*') ? 'active' : ''}}">
                    <a href="{{route('admin.categories.index')}}">
                        <i class="material-icons">layers</i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/customers*') ? 'active' : ''}}">
                    <a href="{{route('admin.customers.index')}}">
                        <i class="material-icons">person</i>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/suppliers*') ? 'active' : ''}}">
                    <a href="{{route('admin.suppliers.index')}}">
                        <i class="material-icons">person</i>
                        <span>Sellers</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/reviews*') ? 'active' : ''}}">
                    <a href="{{route('admin.reviews.index')}}">
                        <i class="material-icons">star_rate</i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/reports/sales-summary*') ? 'active' : ''}}">
                    <a href="{{route('admin.reports.salesSummary')}}">
                        <i class="material-icons">bar_chart</i>
                        <span>Sales Summary</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/reports/product-authentication-status*') ? 'active' : ''}}">
                    <a href="{{route('admin.reports.productAuthenticationStatus')}}">
                        <i class="material-icons">verified_user</i>
                        <span>Product Authentication Status</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/reports/seller-performance*') ? 'active' : ''}}">
                    <a href="{{route('admin.reports.supplierPerformance')}}">
                        <i class="material-icons">trending_up</i>
                        <span>Seller Performance</span>
                    </a>
                </li>

            </ul>
        @endauth
            @auth('authen')
                <ul class="list">
                    <li class="{{request()->is('admin/home') || request()->is('admin/profile') ? 'active' : ''}}">
                        <a href="{{route('admin.home')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
{{--                    <li class="{{request()->is('admin/products-check*') ? 'active' : ''}}">--}}
{{--                        <a href="{{route('admin.products_check.index')}}">--}}
{{--                            <i style="color: green;" class="material-icons text-success">verified_user</i>--}}
{{--                            <span>Products(Checked)</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="{{request()->is('admin/products-check*') ? 'active' : ''}}">
                        <a href="{{route('admin.products_check.index')}}">
                            <i style="color: darkred;" class="material-icons text-danger">verified_user</i>
                            <span>Products(To Check)</span>
                        </a>
                    </li>
                </ul>
            @endauth
        @auth('seller')
            <ul class="list">
                <li class="{{request()->is('seller/home') || request()->is('seller/profile') ? 'active' : ''}}">
                    <a href="{{route('seller.home')}}">
                        <i class="material-icons">home</i>
                        <span>Control Board</span>
                    </a>
                </li>
                <li class="{{request()->is('seller/products*') ? 'active' : ''}}">
                    <a href="{{route('seller.products.index')}}">
                        <i class="material-icons">verified_user</i>
                        <span>My Products</span>
                    </a>
                </li>
                <li class="{{request()->is('seller/verification/checking') ? 'active' : ''}}">
                    <a href="{{route('seller.products.checking')}}">
                        <i class="material-icons">shopping_basket</i>
                        <span>Products(checking)</span>
                    </a>
                </li>

                <li class="{{request()->is('seller/reviews*') ? 'active' : ''}}">
                    <a href="{{route('seller.reviews.index')}}">
                        <i class="material-icons">star_rate</i>
                        <span>My Reviews</span>
                    </a>
                </li>
                <li class="{{request()->is('seller/deals*') ? 'active' : ''}}">
                    <a href="{{route('seller.deals.index')}}">
                        <i class="material-icons">border_color</i>
                        <span>My Deals</span>
                    </a>
                </li>

                <li class="{{request()->is('seller/topSellingProducts*') ? 'active' : ''}}">
                    <a href="{{route('seller.topSellingProducts')}}">
                        <i class="material-icons">insert_drive_file</i>
                        <span>Top Selling</span>
                    </a>
                </li>
            </ul>
        @endauth
    </div>
</aside>
