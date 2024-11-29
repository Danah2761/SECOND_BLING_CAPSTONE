@extends('admin.layouts.app')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('admin.home') }}">
                                <i class="material-icons">home</i> Home
                            </a>
                        </li>
                        <li class="active">
                            <i class="material-icons">person</i> Profile
                        </li>
                    </ol>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <a href="{{ route('admin.home') }}" class="btn btn-danger text-white btn-circle waves-effect waves-circle waves-float">
                                <i class="material-icons text-white">chevron_right</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        <div class="row padding">
                            <!-- Username -->
                            <label for="username">Username</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="username" class="form-control" name="username"
                                           value="{{ old('username', $admin->username) }}"
                                           placeholder="Enter username" required>
                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <label for="email">Email</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" id="email" class="form-control" name="email"
                                           value="{{ old('email', $admin->email) }}"
                                           placeholder="Enter email" required>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <label for="phone">Phone</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="phone" class="form-control" name="phone"
                                           value="{{ old('phone', $admin->phone) }}"
                                           placeholder="Enter phone number" required>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Password (Optional) -->
                            <label for="password">Password</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" class="form-control" name="password"
                                           placeholder="Enter password (if you want to change)">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <label for="password">Password Confirmation</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                                           placeholder="Enter password Confirmation (if you want to change)">
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="col-md-12 text-center pb-4">
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
