@extends('customer.layouts.app')

@push('css')
    <style>
        /* Hero Section Styling */
        .hero-section {
            position: relative;
            height: 500px;
            background-image: url('{{ asset("banner.jpg") }}'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Overlay to darken the background image */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* Dark overlay */
            z-index: 1;
        }

        /* Hero content */
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            text-align: left;
        }

        .hero-content .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0 0 20px;
            font-size: 1rem;
            color: #ccc;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
            margin: 0;
            color: #fff;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: #ddd;
            margin-top: 10px;
        }

        /* Filter bar container */
        .filter-bar {
            background-color: #f8f9fa;
            padding: 10px 0;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        /* Filter dropdowns styling */
        .filter-dropdown {
            position: relative;
        }

        .filter-dropdown button {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 8px 15px;
            color: #333;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            border-radius: 5px;
            width: 185px;
        }

        .filter-dropdown button i {
            margin-left: 5px;
        }

        .filter-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .filter-dropdown-menu a {
            display: block;
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
        }

        .filter-dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        /* Show dropdown on hover */
        .filter-dropdown:hover .filter-dropdown-menu {
            display: block;
        }

        /* Modal filter styling */
        .modal.left .modal-dialog {
            left: 24%;
            position: fixed;
            margin: auto;
            width: 320px;
            height: 100%;
            transform: translate3d(-100%, 0, 0);
            transition: 0.3s ease-out;
        }

        .modal.left .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.left.fade.in .modal-dialog {
            transform: translate3d(0, 0, 0);
        }

        .star-filter i {
            font-size: 20px;
            cursor: pointer;
        }

        .star-filter i.selected,
        .star-filter i:hover {
            color: gold;
        }

        .jewellery_img img {
            height: 250px;
            object-fit: cover;
        }

        .price_text {
            position: absolute;
            top: 0;
            background: #c3c3c3;
            width: 46%;
            left: 15px;
            padding: 13px;
            border-bottom-right-radius: 41px;
        }

        .stars4 {
            text-align: center;
            margin: 16px 0;
        }
        .searcBottom {
            background-color: #f8f8f0;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between
        }
        .shirt_text {
            width: 100%;
            font-size: 16px;
            color: #30302e;
            text-align: center;
            font-weight: 200;
            padding-bottom: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="fashion_section">
        <div class="hero-section">
        <div class="hero-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                </ol>
            </nav>
            <h1 class="text-white text-center">Second Bling</h1>
            <h2 class="text-white text-center">Where luxury and sustainability shine together
            </h2>
        </div>
    </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <!-- Keyword Filter -->
            <div class="filter-dropdown">
                <button>
                    Keyword <i class="fa fa-chevron-down"></i>
                </button>
                <div class="filter-dropdown-menu">
                    <form method="GET" action="{{ route('products.index') }}" class="p-2">
                        <input type="text" name="keyword" class="form-control" placeholder="Search by product name">
                        <button type="submit" class="btn btn-primary mt-2">Apply</button>
                    </form>
                </div>
            </div>

            <!-- Category Filter Dropdown -->
{{--            <div class="filter-dropdown">--}}
{{--                <button>--}}
{{--                    Category <i class="fa fa-chevron-down"></i>--}}
{{--                </button>--}}
{{--                <div class="filter-dropdown-menu">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <a href="?category={{ $category->category_id }}">{{ $category->category_name }}</a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="filter-dropdown">
                <button>
                    Sort by <i class="fa fa-chevron-down"></i>
                </button>
                <div class="filter-dropdown-menu">
                    <a href="?sort=price_low_high">Price: Low to High</a>
                    <a href="?sort=price_high_low">Price: High to Low</a>
                </div>
            </div>

            <!-- Price Range Filter Dropdown -->
            <div class="filter-dropdown">
                <button>
                    Price <i class="fa fa-chevron-down"></i>
                </button>
                <div class="filter-dropdown-menu">
                    <form method="GET" action="{{ route('products.index') }}" class="p-2">
                        <div class="row">
                            <div class="col-6">
                                <input type="number" name="min_price" class="form-control" placeholder="Min Price">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" class="form-control" placeholder="Max Price">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Apply</button>
                    </form>
                </div>
            </div>

            <!-- Rating Filter Dropdown -->
            <div class="filter-dropdown">
                <button>
                    Rating <i class="fa fa-chevron-down"></i>
                </button>
                <div class="filter-dropdown-menu">
                    <form method="GET" action="{{ route('products.index') }}" class="p-2">
                        <div id="star-filter" class="star-filter">
                            @for ($i = 1; $i <= 5; $i++)
                                <a href="?stars={{ $i }}">
                                    @for ($j = 1; $j <= 5; $j++)
                                        <i class="fa fa-star {{ $j <= $i ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </a>
                            @endfor
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sort by Price Filter Dropdown -->

            <!-- Product Count -->
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-secondary" style="font-weight: bold;">clear all</a>
            </div>
        </div>
        <!-- Product Count Display -->
        <div class="searcBottom">
           <div>
               <span style="font-weight: bold;">{{ $products->count() }} Results</span> <!-- Dynamic count of results -->
           </div>
        </div>

        <!-- Product Listing Section -->

        <div class="container">
            <div class="row" style="margin-bottom: 15px;">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-sm-4">
                        <div class="box_main">
                            <p class="price_text"> Price <span style="color: #262626;">SAR {{ $product->price }}</span></p>
                            <div class="jewellery_img">
                                <img src="{{ $product->image_path }}" alt="{{ $product->product_name }}" class="img-fluid">
                            </div>
                            <h4 class="shirt_text">{{ $product->product_name }}</h4>
                            <div class="star-rating stars4">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{ $i <= $product->reviews->avg('rating') ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <div class="btn_main boxCart">
                                <div class="seemore_bt text-center">
                                    <a class="text-white" href="{{ route('products.show', $product->product_id) }}">Shop Now <i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Filter Modal -->
    <div class="modal left fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{ route('products.index') }}">
                        <div class="form-group">
                            <label for="keyword">Keyword</label>
                            <input type="text" name="keyword" class="form-control" placeholder="Search by product name">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="category">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price_range">Price Range</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" name="min_price" class="form-control" placeholder="Min Price">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="max_price" class="form-control" placeholder="Max Price">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stars">Rating</label>
                            <div id="star-filter" class="star-filter">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star" data-value="{{ $i }}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="stars" id="stars" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#star-filter i').on('click', function() {
                var starValue = $(this).data('value');
                $('#star-filter i').removeClass('selected');
                $(this).prevAll().addClass('selected');
                $(this).addClass('selected');
                $('#stars').val(starValue);
            });
        });
    </script>
@endpush
