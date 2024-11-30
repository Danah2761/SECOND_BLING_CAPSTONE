@extends('customer.layouts.app')

@push('css')
    <style>
        .contact-us-page {
            background-color: #f9f9f9;
            padding: 50px 0;
            text-align: center;
        }

        .contact-us-page h1 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            font-weight: bold;
            color: #333;
        }

        .contact-us-page .contact-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s;
        }

        .contact-us-page .contact-box:hover {
            transform: translateY(-5px);
        }

        .contact-us-page .icon {
            font-size: 3rem;
            color: #3498db;
            margin-bottom: 15px;
        }

        .contact-us-page h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .contact-us-page p {
            font-size: 1.2rem;
            color: #555;
        }

        .contact-us-page .contact-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .contact-us-page .contact-box {
            width: 300px;
        }
    </style>
@endpush

@section('content')
    <div class="contact-us-page fashion_section">
        <div class="container">
            <h1>Contact Us</h1>

            <!-- Contact Information Boxes -->
            <div class="contact-container">
                <!-- Email Box -->
                <div class="contact-box">
                    <i class="icon fa fa-envelope"></i>
                    <h3>Email Us</h3>
                    <p>info@secondbling.com</p>
                </div>

                <!-- Phone Box -->
                <div class="contact-box">
                    <i class="icon fa fa-phone"></i>
                    <h3>Call Us</h3>
                    <p>+966 555 555 555</p>
                </div>

                <!-- WhatsApp Box -->
                <div class="contact-box">
                    <i class="icon fa fa-whatsapp"></i>
                    <h3>WhatsApp Us</h3>
                    <p>+966 555 555 555</p>
                </div>
            </div>
        </div>
    </div>
@endsection
