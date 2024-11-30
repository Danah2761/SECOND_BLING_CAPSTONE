@extends('customer.layouts.app')

@push('css')
    <style>
        .fashion_section {
            /*background-color: #f9f9f9;*/
            padding: 50px 0;
            text-align: center;
        }
        .sec {
            background: #fafafa;
            border-radius: 10px;
            padding: 13px;
            border-bottom: 1px solid #a3a3a3;
        }
        .fashion_section .logo {
            margin-bottom: 30px;
        }

        .fashion_section h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .fashion_section p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 40px;
        }

        .fashion_section .section {
            margin-bottom: 50px;
        }

        .fashion_section .icon {
            font-size: 3rem;
            color: #3498db;
            margin-bottom: 15px;
        }

        .fashion_section h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            font-weight: bold;
            color: #333;
        }

        .fashion_section ul {
            list-style-type: none;
            padding: 0;
        }

        .fashion_section ul li {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 10px;
            text-align: left;
        }

        .fashion_section .section-icons {
            display: flex;
            justify-content: center;
        }

        .fashion_section .icon-container {
            display: inline-block;
            text-align: center;
            width: 100%;
        }
        .boxabout {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="fashion_section mt-5">
        <div class="container">
            <!-- Logo Section -->


            <!-- Page Title -->
            <h1>About Us</h1>

            <!-- Introduction -->
            <div class="row sec">
                <div class="col-md-4">
                    <div class="logo">
                        <img src="{{ asset('logo.png') }}" alt="Second Bling Logo" class="img-fluid" style="max-width: 150px;">
                    </div>
                </div>
                <div class="col-md-8">
                    <p class="text-left">
                        Welcome to Second Bling, a platform where luxury meets sustainability. Our mission is to provide a seamless and trustworthy experience for buying and selling pre-owned jewelry, while promoting environmental awareness and responsible consumption.
                    </p>
                </div>
            </div>


            <div class="row sec">
            <div class="section col-md-12">
                <div class="">
                    <i class="icon fa fa-gem"></i>
                    <h3>Who We Are</h3>
                    <p>
                        We are an innovative platform dedicated to streamlining the sale and purchase of high-quality pre-owned gemstones and jewelry, ensuring both luxury and sustainability for our customers.
                    </p>
                </div>
            </div>
            </div>
            <div class="row sec">
            <!-- Our Mission Section -->
            <div class="section">
                <div class="icon-container">
                    <i class="icon fa fa-leaf"></i>
                    <h3>Our Mission</h3>
                    <p>
                        Our mission is to protect the environment by promoting the reuse of gemstones and reducing the demand for newly mined stones. We offer affordable luxury while supporting sustainability.
                    </p>
                </div>
            </div>
            </div>

            <div class="row sec">
            <div class="section">
                <h3>Why Choose Us?</h3>
                <div class="section-icons">
                    <div class="col-md-3">
                        <div class="icon-container boxabout">
                            <i class="icon fa fa-shield"></i>
                            <p>High security and authenticity guarantee</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="icon-container boxabout">
                            <i class="icon fa fa-dollar"></i>
                            <p>Competitive pricing for buyers and sellers</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="icon-container boxabout">
                            <i class="icon fa fa-thumbs-up"></i>
                            <p>Trusted platform with excellent customer service</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="icon-container boxabout">
                            <i class="icon fa fa-recycle"></i>
                            <p>Environmentally responsible shopping</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
@endsection
