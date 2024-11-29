<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Register | Seller</title>
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
            height:auto;
            margin: 0;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('{{ asset('bg55.jpg') }}'); /* Background image */
            background-size: cover;
            background-position: center;
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
        .login-box {
            z-index: 2;
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
            margin-top: 33px;

        }
        .welcome-text {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
       input {
            padding: 9px !important;
        }
        .logo img {
            width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<div class="overlay"></div>

<div style="width: 500px;" class="login-box">
    <div class="logo">
        <img src="{{ asset('logo.png') }}" alt="Logo">
    </div>
    <p class="welcome-text">Join Second Bling as a Seller</p>
    <div class="body">
        <form method="POST" action="{{ route('seller.register') }}">
            @csrf

            <!-- Full Name -->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                    <span class="text-danger">*</span>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control @error('fullName') is-invalid @enderror" name="fullName" placeholder="Full Name" value="{{ old('fullName') }}" required>
                </div>
                @error('fullName')
                <span class="invalid-feedback text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">email</i>
                    <span class="text-danger">*</span>

                </span>
                <div class="form-line">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                <span class="invalid-feedback text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Company Name -->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">business</i>

                </span>
                <div class="form-line">
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}" >
                </div>
                @error('company_name')
                <span class="invalid-feedback text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Company Phone -->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">phone</i>

                </span>
                <div class="form-line">
                    <input type="text" class="form-control @error('company_phone') is-invalid @enderror" name="company_phone" placeholder="Company Phone" value="{{ old('company_phone') }}" >
                </div>
                @error('company_phone')
                <span class="invalid-feedback text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Company Address -->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">location_on</i>

                </span>
                <div class="form-line">
                    <input type="text" class="form-control @error('company_address') is-invalid @enderror" name="company_address" placeholder="Company Address" value="{{ old('company_address') }}" >
                </div>
                @error('company_address')
                <span class="invalid-feedback text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                                        <span class="text-danger">*</span>

                </span>
                <div class="form-line">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                </div>
                @error('password')
                <span class="invalid-feedback text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                                        <span class="text-danger">*</span>

                </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
            </div>

            <div class="form-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I accept <a href="#" data-toggle="modal" data-target="#termsModal">terms and conditions</a></label>
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-block bg-pink waves-effect" type="submit">REGISTER</button>
                </div>
            </div>
            <div class="row m-t-15 m-b--20">
                <div class="col-xs-12 text-center">
                    <a href="{{ route('seller.login') }}">Have an account? Login Now</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol style="    line-height: 28px;
    background: #f0f0f0;
    padding: 32px;">
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>Sellers must be at least 18 years old and capable of entering into legally binding agreements.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>Sellers agree to provide accurate and truthful information about their identity and contact details requested by Second Bling.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>Sellers must provide detailed, accurate descriptions of their items, specifications (metal type, gemstones, weight, etc.), and any notable flaws.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>All images uploaded by sellers must reflect the true condition of the item. And the images must meet the conditions that is set by Second Bling.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>The seller is not permitted to list the same item more than once. Any duplicate listings will result in the item being removed.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>Second Bling charges a 2% commission on the final sale price, as well as any applicable processing fees, which will be deducted from the seller’s payout.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>Sellers must guarantee that all items are authentic and accurately represented. Counterfeit items are strictly prohibited, and any seller found listing inauthentic jewelry may face permanent account suspension from Second Bling and 2% of the price will be deducted from the seller as a penalty.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>If the item displayed by the seller contains precious stones, a certificate verifying the authenticity and details of the stones must be provided.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>To complete the sale, the seller is required to issue an invoice that includes key details: the buyer’s name, date of sale, item’s weight, price, a detailed description of the item, the store’s name and address, and the commercial registration number. Without this the sale cannot be finalized.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>Second Bling reserves the right to suspend or terminate seller accounts for any breach of these terms, suspected fraud, or violation of applicable laws.</strong></span></span></li>
                    <li><span style="font-family:Calibri, sans-serif;font-size:13pt;"><span lang="EN-GB" dir="ltr"><strong>By listing an item on Second Bling the seller acknowledges that they have read, understood, and agree to abide by these terms and conditions.</strong></span></span></li>
                </ol>
            </div>
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
