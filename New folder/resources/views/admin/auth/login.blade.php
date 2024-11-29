<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Admin Panel</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('admin/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
    <style>
        html, body {
            /*height: 100%;*/
            /*margin: 0;*/
            /*overflow-x: hidden;*/
            /*display: flex;*/
            /*align-items: center;*/
            /*justify-content: center;*/
            background-image: url('{{ asset('bg55.jpg') }}'); /* Background image */
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
        }
        .fp-box {
            z-index: 2;
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo img {
            width: 120px;
            margin-bottom: 10px;
        }
        .logo .text-dark {
            font-size: 1.5rem;
            font-weight: bold;
            color: black !important;
        }
        .msg {
            margin-bottom: 20px;
            font-size: 12px;
            color: #333;
        }
        .welcome-text {
            font-size: 2.2rem;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        input {
            padding: 9px !important;
        }
    </style>
</head>

<body class="login-page">
<div class="">

    <div class="card">
        <div class="logo text-center">
            <img style="height: 100px;margin-top: 10px;" src="{{ asset('logo.png') }}">
        </div>
        <h5 class="text-center" style="color: black !important;">Welcome Back</h5>

        <div class="body">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <!-- Select to choose login as Admin or Authenticator -->
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">group</i>
                </span>
                    <div class="form-line">
                        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="authenticator" {{ old('role') == 'authenticator' ? 'selected' : '' }}>Authenticator</option>
                        </select>
                    </div>
                    @error('role')
                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                    <div class="form-line">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                    <div class="form-line">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                    </div>
                    @error('password')
                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>



                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">LOGIN</button>
                    </div>
                </div>

                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6 align-right">
                        <a href="{{ route('admin.password.request') }}">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('admin/plugins/node-waves/waves.js') }}"></script>

<!-- Validation Plugin Js -->
<script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('admin/js/admin.js') }}"></script>
<script src="{{ asset('admin/js/pages/examples/sign-in.js') }}"></script>
</body>

</html>
