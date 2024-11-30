@extends('customer.layouts.app')

@section('content')
    <div class="jewellery_section">
        <div class="container">
            <h1 class="fashion_taital">Jewellery Accessories</h1>
            @if(request('keyword'))
               <div class="d-flex justify-content-between">
                   <div><p>Results for "{{ request('keyword') }}"</p></div>
                   <div>                   <a href="{{ route('home') }}" class="btn btn-danger">Clear Search</a>
                   </div>
               </div>
            @endif
            <div class="fashion_section_2">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-sm-4">
                            <div class="box_main">
                                <h4 class="shirt_text">{{ $product->product_name }}</h4>
                                <p class="price_text"> Price <span style="color: #262626;">SAR {{ $product->price }}</span></p>
                                <div class="jewellery_img">
                                    <img src="{{ $product->image_path }}" alt="{{ $product->product_name }}" class="img-fluid">
                                </div>
                                <div class="btn_main boxCart">
{{--                                    <div class="buy_bt">--}}
{{--                                        <a href="#">Seller : {{optional($product->supplier)->fullName}}</a>--}}
{{--                                    </div>--}}
                                    <div class="seemore_bt text-center">
                                        <a class="text-white" href="{{route('products.show', $product->product_id)}}">shop Now <i class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
