@extends('customer.layouts.app')

@section('content')
    <div class="fashion_section mt-5" style="background-image: url('{{asset('bg55.jpg')}}'); background-size: cover; background-position: center;">
        <div class="container">
            <h1 class="fashion_taital">Welcome Back!</h1>
            <div class="fashion_section_2">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 mx-auto">
                        <div style="width: 100%;
    background-color: #ffffff94;
    height: auto;
    padding: 20px;
     box-shadow: none;
    margin-bottom: 20px;" class="box_main p-4">
                            <form action="{{ route('customer.login') }}" method="POST">
                                @csrf <!-- CSRF token for Laravel -->

                                <!-- Email input -->
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btnCusomt btn-primary btn-block">Login</button>

                                <!-- Forgot Password -->
                                <div class="mt-3 text-center">
                                    <a href="{{route('customer.register')}}">Don’t have an account? Register Now</a>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="{{route('customer.forgot_password')}}">Forgot Password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
