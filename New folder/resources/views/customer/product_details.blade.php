{{--@extends('customer.layouts.app')--}}
{{--@push('css')--}}
{{--    <link rel="stylesheet" href="{{ asset('customer/css/pro.css') }}">--}}
{{--@endpush--}}
{{--@section('content')--}}
{{--    <div class="jewellery_section">--}}
{{--        <div class="container">--}}
{{--            <div class="pd-wrap">--}}
{{--                <div class="container">--}}
{{--                    <div class="heading-section">--}}
{{--                        <h2>Product Details</h2>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <!-- Product Image -->--}}
{{--                        <div class="col-md-4">--}}
{{--                            <img src="{{ $product->image_path }}" alt="{{ $product->product_name }}" class="img-fluid">--}}
{{--                        </div>--}}
{{--                        <!-- Product Info -->--}}
{{--                        <div class="col-md-8">--}}
{{--                            <div class="product-dtl">--}}
{{--                                <div class="product-info">--}}
{{--                                    <div class="product-name">{{ $product->product_name }}</div>--}}
{{--                                    <!-- Reviews and Rating -->--}}
{{--                                    <div class="reviews-counter">--}}
{{--                                        <div class="rate">--}}
{{--                                            @for ($i = 5; $i >= 1; $i--)--}}
{{--                                                <input type="radio" id="star{{ $i }}" name="rate"--}}
{{--                                                       value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }}/>--}}
{{--                                                <label for="star{{ $i }}" title="text">{{ $i }} stars</label>--}}
{{--                                            @endfor--}}
{{--                                        </div>--}}
{{--                                        <span>{{ $product->reviews->count() }} Reviews</span>--}}
{{--                                    </div>--}}
{{--                                    <!-- Price -->--}}
{{--                                    <div class="product-price-discount">--}}

{{--                                        <span>SAR {{ $product->price }}</span>--}}

{{--                                        <p><strong>Category:</strong> {{ $product->category->category_name }}</p>--}}
{{--                                        <p><strong>Seller:</strong> {{ $product->supplier->fullName }}</p>--}}
{{--                                        <p><strong>Stock Quantity:</strong> {{ $product->stock_quantity }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- Quantity and Add to Cart -->--}}
{{--                                <div class="row product-count">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label for="size">Quantity</label>--}}
{{--                                        <form action="#" class="display-flex">--}}
{{--                                            <div class="qtyminus">-</div>--}}
{{--                                            <input type="text" name="quantity" value="1" class="qty">--}}
{{--                                            <div class="qtyplus">+</div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <a href="#" class="round-black-btn">Add to Cart</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Product Info Tabs -->--}}
{{--                    <div class="product-info-tabs">--}}
{{--                        <ul class="nav nav-tabs" id="myTab" role="tablist">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"--}}
{{--                                   role="tab" aria-controls="description" aria-selected="true">Description</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"--}}
{{--                                   aria-controls="review" aria-selected="false">Reviews--}}
{{--                                    ({{ $product->reviews->count() }})</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <div class="tab-content" id="myTabContent">--}}
{{--                            <!-- Description Tab -->--}}
{{--                            <div class="tab-pane fade show active" id="description" role="tabpanel"--}}
{{--                                 aria-labelledby="description-tab">--}}
{{--                                {!! $product->description !!}--}}
{{--                            </div>--}}
{{--                            <!-- Review Tab -->--}}
{{--                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">--}}
{{--                                <div class="review-heading">REVIEWS</div>--}}
{{--                                @if($product->reviews->isEmpty())--}}
{{--                                    <p class="mb-20">There are no reviews yet.</p>--}}
{{--                                @else--}}
{{--                                    @foreach($product->reviews as $review)--}}
{{--                                        <div class="media mb-4">--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h5 class="mt-0">{{ $review->customer->fullName }}</h5>--}}
{{--                                                <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>--}}
{{--                                                <p>{{ $review->comment }}</p>--}}
{{--                                                <small><em>{{ date('F d, Y', strtotime($review->review_date)) }}</em></small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <hr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                                <!-- Review Form -->--}}
{{--                                <form class="review-form">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Your rating</label>--}}
{{--                                        <div class="rate">--}}
{{--                                            @for ($i = 5; $i >= 1; $i--)--}}
{{--                                                <input type="radio" id="star{{ $i }}_review" name="rate_review"--}}
{{--                                                       value="{{ $i }}"/>--}}
{{--                                                <label for="star{{ $i }}_review" title="text">{{ $i }} stars</label>--}}
{{--                                            @endfor--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Your message</label>--}}
{{--                                        <textarea class="form-control" rows="5"></textarea>--}}
{{--                                    </div>--}}
{{--                                    <button class="round-black-btn">Submit Review</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
{{--@push('js')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $(".qtyminus").on("click", function () {--}}
{{--                var now = $(".qty").val();--}}
{{--                if ($.isNumeric(now)) {--}}
{{--                    if (parseInt(now) - 1 > 0) {--}}
{{--                        now--;--}}
{{--                    }--}}
{{--                    $(".qty").val(now);--}}
{{--                }--}}
{{--            })--}}
{{--            $(".qtyplus").on("click", function () {--}}
{{--                var now = $(".qty").val();--}}
{{--                if ($.isNumeric(now)) {--}}
{{--                    $(".qty").val(parseInt(now) + 1);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
{{--@endpush--}}
@extends('customer.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('customer/css/pro.css') }}">
@endpush

@section('content')
    <div class="jewellery_section">
        <div class="container">
            <div class="pd-wrap">
                    <div class="heading-section">
                        <h2>Product Details</h2>
                    </div>
                    <div class="row">
                        <!-- Product Image -->
                        <div class="col-md-4">
                            <img src="{{ $product->image_path }}" alt="{{ $product->product_name }}" class="img-fluid product-img">
                        </div>
                        <!-- Product Info -->
                        <div class="col-md-8">
                            <form method="post" action="{{route('customer.addToCart')}}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                <div class="product-dtl">
                                    <div class="product-info">
                                        <div class="product-name">{{ $product->product_name }}</div>
                                        <!-- Reviews and Rating -->
                                        <div class="reviews-counter d-flex align-items-center">
                                            <div class="rate">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa text-warning fa-star{{ $i <= round($product->reviews->avg('rating')) ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                            <span>{{ $product->reviews->count() }} Reviews</span>
                                        </div>
                                        <!-- Price -->
                                        <div class="product-price-discount">
                                            <span>SAR {{ $product->price }}</span>
                                        </div>
                                        <p><strong>Category:</strong> {{ $product->category->category_name }}</p>
                                        <p><strong>Seller:</strong> {{ $product->seller->fullName }}</p>
                                        <p><strong>Stock Quantity:</strong> {{ $product->stock_quantity }}</p>
                                    </div>
                                    <!-- Quantity and Add to Cart -->
                                    <div class="row product-count">
                                        <div class="col-md-6 display-flex align-center">
                                            <form action="#" class="display-flex">
                                                <div class="qtyminus">-</div>
                                                <input type="text" name="quantity" value="1" class="qty">
                                                <div class="qtyplus">+</div>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="round-black-btn"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                                        </div>
                                    </div>
                                    <div class="alert alert-danger mt-3 out-of-stock-message" style="display: none;">This product is out of stock.</div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- Product Info Tabs -->
                    <div class="product-info-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"
                                   role="tab" aria-controls="description" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                   aria-controls="review" aria-selected="false">Reviews
                                    ({{ $product->reviews->count() }})</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!-- Description Tab -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                 aria-labelledby="description-tab">
                                {!! $product->description !!}
                            </div>
                            <!-- Review Tab -->
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                @if($product->reviews->isEmpty())
                                    <p class="mb-20">There are no reviews yet.</p>
                                @else
                                    @foreach($product->reviews as $review)
                                        <div class="media mb-4">
                                            <div class="media-left">
                                                <i class="fa fa-user-circle fa-2x mr-2"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="mt-0">{{ $review->customer->full_name }}</h5>
                                                <div class="rate">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fa text-warning fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                                    @endfor
                                                        <p>{{ $review->comment }}</p>

                                                </div>
                                            </div>
                                            <small><em>{{ date('Y-m-d H:i A', strtotime($review->review_date)) }}</em></small>



                                        </div>
                                        <hr>
                                    @endforeach
                                @endif
                                <!-- Review Form -->
                                <form action="{{ route('customer.addNewReview') }}" method="POST" class="review-form">
                                    <h4>Add Your Feedback</h4>
                                    <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Your rating</label>
                                        <div class="rate">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}_review" name="rate_review"
                                                       value="{{ $i }}"/>
                                                <label for="star{{ $i }}_review" title="text">{{ $i }} stars</label>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Your message</label>
                                        <textarea class="form-control" name="comment" rows="3"></textarea>
                                    </div>
                                    <button class="round-black-btn">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Products Section -->
                <div class="fashion_section">
                    <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($similarProducts->chunk(3) as $chunkIndex => $productChunk)
                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                    <div class="container">
                                        <h1 style="font-size: 19px;" class="fashion_taital">Similar Products</h1>
                                        <div class="fashion_section_2">
                                            <div class="row">
                                                @foreach ($productChunk as $similarProduct)
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="box_main">
                                                            <h4 class="shirt_text">{{ $similarProduct->product_name }}</h4>
                                                            <p class="price_text">Price <span style="color: #262626;">SAR {{ $similarProduct->price }}</span></p>
                                                            <div class="electronic_img">
                                                                <img src="{{ $similarProduct->image_path }}" alt="{{ $similarProduct->product_name }}" class="img-fluid">
                                                            </div>
                                                            <div class="btn_main boxCart">
                                                                <div class="seemore_bt text-center">
                                                                    <a class="text-white" href="{{route('products.show', $product->product_id)}}">shop Now <i class="fa fa-shopping-cart"></i></a>
                                                                </div>                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#electronic_main_slider" role="button" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#electronic_main_slider" role="button" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            var stockQuantity = {{ $product->stock_quantity }};
            $(".qtyminus").on("click", function () {
                var now = $(".qty").val();
                if ($.isNumeric(now)) {
                    if (parseInt(now) - 1 > 0) {
                        now--;
                    }
                    $(".qty").val(now);
                }
            });
            $(".qtyplus").on("click", function () {
                var now = $(".qty").val();
                if ($.isNumeric(now)) {
                    if (parseInt(now) < stockQuantity) {
                        $(".qty").val(parseInt(now) + 1);
                    } else {
                        $(".qty").val(1);
                        alert('Cannot add more than available stock.');
                    }
                }
            });
            if (stockQuantity <= 0) {
                $(".product-count, .round-black-btn").hide();
                $(".out-of-stock-message").show();
            }
        });
    </script>
@endpush
