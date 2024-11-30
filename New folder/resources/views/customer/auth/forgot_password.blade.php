@extends('customer.layouts.app')

@section('content')
    <div class="fashion_section mt-5">
        <div class="container">
            <h1 class="fashion_taital">Forgot Password</h1>

            <div class="fashion_section_2">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 mx-auto">
                        <div class="box_main p-4">
                            <form action="#" method="POST">
                                <p>                Enter your email address that you used to register. We'll send you an email with a link to reset your password.
                                </p>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btnCusomt btn-primary btn-block">Reset My Password</button>

                                <!-- Forgot Password -->
                                <div class="mt-3 text-center">
                                    <a href="{{route('customer.login')}}">Back To Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
