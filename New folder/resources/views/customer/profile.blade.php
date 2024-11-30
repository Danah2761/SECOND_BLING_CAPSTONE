@extends('customer.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('customer/css/pro.css') }}">
    <style>
        .product-info-tabs .nav-tabs {
            display: flex;
            justify-content: space-around;
        }
        .product-info-tabs .nav-tabs .nav-item.show .nav-link, .product-info-tabs .nav-tabs .nav-link.active, .product-info-tabs .nav-tabs .nav-link.active:hover {
            border: none;
            color: white;
            border-bottom: 2px solid #d8d8d8;
            font-weight: bold;
            background: #969696;
        }
        .product-info-tabs .tab-content .tab-pane {
            padding: 30px 20px;
            font-size: 15px;
            line-height: 24px;
            color: #7a7a7a;
            background: #ffffff;
            border: 1px solid #ebe3e3;
            border-radius: 11px;
            box-shadow: 1px 1px 8px 4px #d8d5d5;
        }
        .order-status-tracking {
            margin-top: 20px;
        }

        .status-tracking {
            display: flex;
            justify-content: space-between;
            list-style: none;
            padding: 0;
        }

        .status-tracking li {
            position: relative;
            flex: 1;
            text-align: center;
            color: #7a7a7a;
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
            top: 12px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #d8d8d8;
            z-index: -1;
        }

        .status-tracking li:first-child:after {
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
    @php
        $customer = auth('customer')->user();
    @endphp
    <div class="jewellery_section">
        <div class="container">
            <div class="pd-wrap">
                <div class="heading-section">
                    <h2>My Profile</h2>
                </div>
                <div class="product-info-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="personal-info-tab" data-toggle="tab" href="#personal-info"
                               role="tab" aria-controls="personal-info" aria-selected="true">Personal Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="update-profile-tab" data-toggle="tab" href="#update-profile"
                               role="tab" aria-controls="update-profile" aria-selected="false">Update Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password"
                               role="tab" aria-controls="change-password" aria-selected="false">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="my-deals-tab" data-toggle="tab" href="#my-deals"
                               role="tab" aria-controls="my-deals" aria-selected="false">My Deals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="my-reviews-tab" data-toggle="tab" href="#my-reviews"
                               role="tab" aria-controls="my-reviews" aria-selected="false">My Reviews</a>
                        </li>

                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- Personal Info Tab -->
                        <div class="tab-pane fade show active" id="personal-info" role="tabpanel"
                             aria-labelledby="personal-info-tab">
                            <h4>Personal Info</h4>
                            <p><strong>Name:</strong> {{ $customer->full_name }}</p>
                            <p><strong>Email:</strong> {{ $customer->email }}</p>
                            <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                            <p><strong>Address:</strong> {{ $customer->address }}</p>
                        </div>

                        <!-- Update Profile Tab -->
                        <div class="tab-pane fade" id="update-profile" role="tabpanel"
                             aria-labelledby="update-profile-tab">
                            <h4>Update Profile</h4>
                            <form action="{{ route('customer.updateProfile') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{ old('first_name', $customer->first_name) }}">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                           value="{{ old('last_name', $customer->last_name) }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"
                                           value="{{ old('email', $customer->email) }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone"
                                           value="{{ old('phone', $customer->phone) }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address"
                                           value="{{ old('address', $customer->address) }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="change-password" role="tabpanel"
                             aria-labelledby="change-password-tab">
                            <h4>Change Password</h4>
                            <form action="{{ route('customer.updatePassword') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </form>
                        </div>

                        <!-- My Deals Tab -->
                        <div class="tab-pane fade" id="my-deals" role="tabpanel"
                             aria-labelledby="my-deals-tab">
                            <h4>My Deals</h4>
                            @if ($customer->deals->isEmpty())
                                <p>No deals found.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Deal Date</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customer->deals as $index=>$deal)
                                        <tr>
                                            <td>{{$deal->deal_id}}</td>
                                            <td>{{ date('Y-m-d', strtotime($deal->deal_date)) }}</td>
                                            <td>SAR {{ $deal->total_price }}</td>
                                            <td>{{ $deal->deal_status }}</td>
                                            <td><a href="{{route('customer.dealSummary', $deal->deal_id)}}" class="btn btn-primary">View Invoice <i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                        <!-- My Reviews Tab -->
                        <div class="tab-pane fade" id="my-reviews" role="tabpanel" aria-labelledby="my-reviews-tab">
                            <h4>My Reviews</h4>
                            @if($customer->reviews->isEmpty())
                                <p>No reviews found.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($customer->reviews as $review)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('products.show', optional($review->product)->product_id) }}">
                                                        {{ optional($review->product)->product_name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="rate">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fa text-warning fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                                        @endfor
                                                    </div>
                                                </td>
                                                <td>{{ $review->comment }}</td>
                                                <td>{{ date('Y-m-d H:i A', strtotime($review->review_date)) }}</td>
                                                <td>
                                                    <!-- Delete Review -->
                                                    <form id="formFeed{{$review->review_id}}" action="{{ route('customer.deleteReview', $review->review_id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a href="javascript:void(0);" onclick="confirmAction('Are you sure want to delete?', 'formFeed{{$review->review_id}}')" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
