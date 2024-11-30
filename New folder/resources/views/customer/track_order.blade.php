<!-- resources/views/customer/track_order.blade.php -->

@extends('customer.layouts.app')

@push('css')
    <style>
        .order-status-tracking {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .status-tracking {
            display: flex;
            flex-direction: column; /* Make the status items display vertically */
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .status-tracking li {
            position: relative;
            width: 100%;
            text-align: center;
            color: #7a7a7a;
            padding: 10px 0;
        }

        .status-tracking li:before {
            content: '\2713'; /* Checkmark */
            position: relative;
            display: inline-block;
            margin-bottom: 5px;
            width: 25px;
            height: 25px;
            line-height: 25px;
            border-radius: 50%;
            background: #d8d8d8;
            color: white;
            right: 10px;
        }

        .status-tracking li.active:before {
            background: #28a745; /* Green for active status */
        }

        .status-tracking li.canceled:before {
            background: #dc3545; /* Red for canceled */
        }

        .status-tracking li:after {
            content: '';
            position: absolute;
            top: 50%;
            left: calc(50% + -41px);
            width: 2px;
            height: 100%;
            background: #d8d8d8;
            z-index: -1;

        }

        .status-tracking li:last-child:after {
            display: none;
        }

        .status-tracking li.active + li:after {
            background: #28a745;
        }

        .status-tracking li.canceled + li:after {
            background: #dc3545; /* Red line for canceled */
        }
    </style>

@endpush

@section('content')
    <div class="jewellery_section">
        <div class="container">
            <div class="pd-wrap">
                <div class="heading-section">
                    <h1 class="text-center" >Track Order</h1>
                </div>
                <div style="width: 50%;margin:auto;">
                    <form action="{{ route('customer.trackOrder') }}" method="GET">
                        <div class="form-group">
                            <label for="order_number">Order Number</label>
                            <input type="text" name="order_number" class="form-control" placeholder="Enter Order Number" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Track</button>
                    </form>
                    @if(isset($order))
                        <div class="order-status-tracking">
                            <ul class="status-tracking">
                                <li class="{{ $order->deal_status == 'pending' ? 'active' : '' }}">Pending</li>
                                <li class="{{ $order->deal_status == 'shipped' ? 'active' : '' }}">Shipped</li>
                                <li class="{{ $order->deal_status == 'delivered' ? 'active' : '' }}">Delivered</li>
                                <li class="{{ $order->deal_status == 'canceled' ? 'active canceled' : '' }}">Canceled</li>
                            </ul>
                        </div>
                    @endif
                </div>
                </div>
        </div>
    </div>
@endsection
