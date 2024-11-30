@extends('customer.layouts.app')

@section('content')
    <div class="jewellery_section">
        <div class="container">
            <h2 class="text-center my-4">Shopping Cart</h2>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="row">
                    <!-- Cart Details -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header bfCustom text-white">
                                <h4 class="mb-0">Cart Details</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(session('cart') as $id => $details)
                                        <tr>
                                            <td>
                                                <img src="{{ $details['image_path'] }}" width="60" height="60" class="img-thumbnail" alt="{{ $details['product_name'] }}">
                                            </td>
                                            <td>{{ $details['product_name'] }}</td>
                                            <td>SAR {{ number_format($details['price'], 2) }}</td>
                                            <td>{{ $details['quantity'] }}</td>
                                            <td>SAR {{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                            <td>
                                                <!-- Remove Button -->
                                                <form action="{{ route('customer.cart.remove', $id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header bfCustom text-white">
                                <h4 class="mb-0">Cart Summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="cart-total">
                                    <h5><strong>Subtotal:</strong> SAR {{ number_format($total - 100, 2) }}</h5>
                                    <h5><strong>Shipping:</strong> SAR 100.00</h5>
                                    <h4><strong>Total:</strong> SAR {{ number_format($total, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping & Payment Information -->
                <div class="row">
                    <!-- Shipping Information -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header bfCustom text-white">
                                <h4 class="mb-0">Shipping Information</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('customer.updateShippingInfo') }}" method="POST">
                                    @csrf
                                    @csrf
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" value="{{ old('address', $shippingInfo->address ?? '') }}" class="form-control @error('address') is-invalid @enderror" required>
                                        @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="city">City</label>
                                            <input type="text" id="city" name="city" value="{{ old('city', $shippingInfo->city ?? '') }}" class="form-control @error('city') is-invalid @enderror" required>
                                            @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="postal_code">Postal Code</label>
                                            <input type="number" id="postal_code" name="postal_code" value="{{ old('postal_code', $shippingInfo->postal_code ?? '') }}" class="form-control @error('postal_code') is-invalid @enderror" required>
                                            @error('postal_code')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="country">Country</label>
                                            <input type="text" id="country" name="country" value="{{ old('country', $shippingInfo->country ?? '') }}" class="form-control @error('country') is-invalid @enderror" required>
                                            @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone</label>
                                            <input type="text" id="phone" name="phone" value="{{ old('phone', $shippingInfo->phone ?? '') }}" class="form-control @error('phone') is-invalid @enderror" required>
                                            @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block">Update Shipping Info</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header bfCustom text-white">
                                <h4 class="mb-0">Payment Information</h4>
                            </div>
                            <div class="card-body">
                                <form id="paymentForm">
                                    <div class="form-group">
                                        <label for="payment_method">Payment Method</label>
                                        <select id="payment_method" class="form-control" required>
                                            <option value="">Select Payment Method</option>
                                            <option value="visa">Visa</option>
                                            <option value="mastercard">MasterCard</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                        <small class="form-text text-danger" id="payment_method_error"></small>
                                    </div>

                                    <div class="form-group" id="card_details">
                                        <label for="card_number">Card Number</label>
                                        <input type="text" id="card_number" class="form-control" placeholder="Enter card number" required>
                                        <small class="form-text text-danger" id="card_number_error"></small>
                                    </div>

                                    <div class="form-row" id="expiration_date_row">
                                        <div class="form-group col-md-6">
                                            <label for="expiration_month">Expiration Month</label>
                                            <select id="expiration_month" class="form-control" required>
                                                <option value="">Month</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                                @endfor
                                            </select>
                                            <small class="form-text text-danger" id="expiration_month_error"></small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="expiration_year">Expiration Year</label>
                                            <select id="expiration_year" class="form-control" required>
                                                <option value="">Year</option>
                                                @for ($i = now()->year; $i <= now()->year + 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <small class="form-text text-danger" id="expiration_year_error"></small>
                                        </div>
                                    </div>

                                    <div class="form-group" id="cvv_row">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" class="form-control" placeholder="Enter CVV" required>
                                        <small class="form-text text-danger" id="cvv_error"></small>
                                    </div>

                                    <button id="placeOrderButton" class="btn btn-primary btn-block">  <i class="fa fa-check-circle"></i> Place Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Place Order Button -->
{{--                <div class="row mt-4">--}}
{{--                    <div class="col-md-12 text-center">--}}
{{--                        <a href="#"  class="btn btn-success btn-lg">--}}

{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @else
                <p class="text-center">Your cart is empty.</p>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cardNumberInput = document.getElementById('card_number');
            const cvvInput = document.getElementById('cvv');
            const placeOrderButton = document.getElementById('placeOrderButton');

            if (cardNumberInput) {
                cardNumberInput.addEventListener('input', function () {
                    const cardNumber = this.value.replace(/\D/g, '').substring(0, 16);
                    this.value = cardNumber;
                    const cardNumberError = document.getElementById('card_number_error');
                    cardNumberError.textContent = cardNumber.length === 16 ? '' : 'Card number must be exactly 16 digits.';
                });
            }

            if (cvvInput) {
                cvvInput.addEventListener('input', function () {
                    const cvv = this.value.replace(/\D/g, '').substring(0, 3);
                    this.value = cvv;
                    const cvvError = document.getElementById('cvv_error');
                    cvvError.textContent = cvv.length === 3 ? '' : 'CVV must be exactly 3 digits.';
                });
            }

            if (placeOrderButton) {
                placeOrderButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    const paymentMethod = document.getElementById('payment_method').value;
                    const cardNumber = cardNumberInput ? cardNumberInput.value : '';
                    const cvv = cvvInput ? cvvInput.value : '';

                    if (!paymentMethod) {
                        alert('Please select a payment method.');
                        return;
                    }

                    if ((paymentMethod === 'visa' || paymentMethod === 'mastercard') && (cardNumber.length !== 16 || cvv.length !== 3)) {
                        alert('Please fill in valid card details.');
                        return;
                    }

                    // Redirect to the placeOrder route
                    window.location.href = `{{ route('customer.placeOrder') }}?payment_method=${paymentMethod}`;
                });
            }
        });

    </script>
@endpush
