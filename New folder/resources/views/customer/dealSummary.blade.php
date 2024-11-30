@extends('customer.layouts.app')

@push('css')
    <style>
        .invoice-header {
            background-color: #c1c1c1;
            color: white;
            padding: 20px;
        }

        .invoice-details {
            padding: 20px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .invoice-summary {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .table th, .table td {
            border-top: none;
        }

        .print-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .print-button:hover {
            background-color: #45a049;
        }
    </style>
@endpush

@section('content')
    <div class="jewellery_section">
        <div class="container">
            <div class="invoice-header text-center">
                <h2>Invoice</h2>
            </div>

            <div class="invoice-details">
                <div class="row">
                    <!-- Order Details -->
                    <div class="col-md-6">
                        <h4>Order Details</h4>
                        <p><strong>Order Number:</strong> {{ $deal->deal_id }}</p>
                        <p><strong>Order Date:</strong> {{ date('d M Y', strtotime($deal->deal_date)) }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($deal->deal_status) }}</p>
                        <p><strong>Shipping Address:</strong> {{ $shippingInfo->address }}, {{ $shippingInfo->city }}, {{ $shippingInfo->state }}, {{ $shippingInfo->postal_code }}, {{ $shippingInfo->country }}</p>
                    </div>
                    <!-- Order Summary -->
                    <div class="col-md-6">
                        <h4>Order Summary</h4>
                        <p><strong>Subtotal:</strong> SAR {{ number_format($deal->dealItems->sum(fn($item) => $item->price * $item->quantity), 2) }}</p>
                        <p><strong>Shipping:</strong> SAR 100.00</p>
                        <p><strong>Shipping Company: </strong> DHL</p>
                        <h4><strong>Total:</strong> SAR {{ number_format($deal->total_price, 2) }}</h4>
                    </div>
                    <div class="col-md-12 ">
                        <h4>Items Ordered</h4>
                        <table class="table table-hover table-bordered">
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
            </div>

            <!-- Items Ordered -->


            <!-- Print Button -->
            <div class="text-center">
                <button class="print-button" onclick="printInvoice()">Print Invoice</button>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function printInvoice() {
            window.print();
        }
    </script>
@endpush
