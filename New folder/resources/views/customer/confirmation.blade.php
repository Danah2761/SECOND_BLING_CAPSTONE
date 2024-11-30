@extends('customer.layouts.app')

@push('css')
    <style>
        .confirmation-header {
            background-color: #c1c1c1;
            color: white;
            padding: 20px;
        }

        .confirmation-content {
            padding: 40px;
            text-align: center;
        }

        .confirmation-image {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .confirmation-message {
            font-size: 24px;
            margin-bottom: 10px;
            color: #4CAF50;
        }

        .confirmation-subtext {
            font-size: 18px;
            color: #777;
            margin-bottom: 20px;
        }

        .view-order-link {
            font-size: 18px;
            color: #3a50b3;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="jewellery_section">
        <div class="container">

                <h1 class="text-center">Thank You!</h1>

            <div class="confirmation-content">
                <p class="confirmation-message">Wait to confirm your order</p>
                <a href="{{route('customer.dealSummary', $deal->deal_id)}}" class="view-order-link">
                    View Your Order Details
                </a>
            </div>
        </div>
    </div>
@endsection
