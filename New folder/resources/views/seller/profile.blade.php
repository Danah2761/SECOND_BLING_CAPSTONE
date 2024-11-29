@extends('admin.layouts.app')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('seller.home') }}">
                                <i class="material-icons">home</i> Home
                            </a>
                        </li>
                        <li class="active">
                            <i class="material-icons">person</i> Supplier Profile
                        </li>
                    </ol>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <a href="{{ route('seller.home') }}" class="btn btn-danger text-white btn-circle waves-effect waves-circle waves-float">
                                <i class="material-icons text-white">chevron_right</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form class="row" action="{{ route('seller.profile.update') }}" method="POST">
                        @csrf

                        <div class="col-md-6">
                        <label for="fullName">Full Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="fullName" class="form-control" name="fullName"
                                       value="{{ old('fullName', $supplier->fullName) }}"
                                       placeholder="Enter Full Name" required>

                            </div>
                            @error('fullName')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="email">Email</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" id="email" class="form-control" name="email"
                                       value="{{ old('email', $supplier->email) }}"
                                       placeholder="Enter Email" required>

                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="company_name">Company Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="company_name" class="form-control" name="company_name"
                                       value="{{ old('company_name', $supplier->company_name) }}"
                                       placeholder="Enter Company Name" required>

                            </div>
                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="company_phone">Company Phone</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="company_phone" class="form-control" name="company_phone"
                                       value="{{ old('company_phone', $supplier->company_phone) }}"
                                       placeholder="Enter Company Phone" required>

                            </div>
                            @error('company_phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="company_address">Company Address</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="company_address" class="form-control" name="company_address"
                                       value="{{ old('company_address', $supplier->company_address) }}"
                                       placeholder="Enter Company Address" required>

                            </div>
                            @error('company_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="password">Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" class="form-control" name="password"
                                       placeholder="Enter password (if you want to change)">

                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="password_confirmation">Password Confirmation</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password_confirmation" class="form-control"
                                       name="password_confirmation"
                                       placeholder="Confirm Password (if you want to change)">

                            </div>
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn w-50 m-t-15 btn-primary waves-effect">
                                <i class="material-icons">verified_user</i> Update Profile
                            </button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
