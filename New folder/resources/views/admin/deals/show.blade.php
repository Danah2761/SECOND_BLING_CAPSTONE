@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="header">
            <ol class="breadcrumb breadcrumb-col-cyan">
                <li>
                    <a href="{{ route('seller.home') }}">
                        <i class="material-icons">home</i> Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('seller.deals.index') }}">
                        <i class="material-icons">border_color</i> Deal
                    </a>
                </li>
                <li class="active">
                    <i class="material-icons">remove_red_eye</i> Deal Details
                </li>
            </ol>
            <ul class="header-dropdown m-r--5">
                <li class="">
                    <a href="{{ route('admin.deals.index') }}"
                       class="btn btn-danger text-white btn-circle waves-effect waves-circle waves-float">
                        <i class="material-icons text-white">chevron_right</i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div class="row">
                <!-- Customer Information -->
                <div class="col-md-4">
                    <h4>Customer Information</h4>
                    <p><strong>Name:</strong> {{ $deal->customer->fullName }}</p>
                    <p><strong>Email:</strong> {{ $deal->customer->email }}</p>
                    <p><strong>Phone:</strong> {{ $deal->customer->phone }}</p>
                </div>

                <!-- Order Information -->
                <div class="col-md-4">
                    <h4>Order Information</h4>
                    <p><strong>Order Number:</strong> {{ $deal->deal_id }}</p>
                    <p><strong>Order Date:</strong> {{ date('d M Y', strtotime($deal->deal_date)) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($deal->deal_status) }}</p>
                    <p><strong>Total Price:</strong> SAR {{ number_format($deal->total_price, 2) }}</p>
                </div>

                <div class="col-md-4">
                    <h4>Shipment Information</h4>
                    @if($deal->customer->shipmentInfo)
                        <p><strong>Address:</strong> {{ $deal->customer->shipmentInfo->address }}</p>
                        <p><strong>City:</strong> {{ $deal->customer->shipmentInfo->city }}</p>
                        <p><strong>Postal Code:</strong> {{ $deal->customer->shipmentInfo->postal_code }}</p>
                        <p><strong>Country:</strong> {{ $deal->customer->shipmentInfo->country }}</p>
                        <p><strong>Phone:</strong> {{ $deal->customer->shipmentInfo->phone }}</p>
                    @else
                        <p>No shipment information available.</p>
                    @endif
                </div>
            </div>

            <!-- Items Ordered -->
            <h4>Items Ordered</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deal->dealItems as $item)
                    <tr>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>SAR {{ number_format($item->price, 2) }}</td>
                        <td>SAR {{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
