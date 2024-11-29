@extends('admin.layouts.app')

@section('content')
    @auth('admin')
    <div class="block-header">
        <h2>Control Board</h2>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">category</i>
            </div>
            <div class="content">
                <div class="text">Categories</div>
                <div class="d">{{ $categoryCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">check_circle</i>
            </div>
            <div class="content">
                <div class="text">Valid Products</div>
                <div class="">{{ $validProductsCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">cancel</i>
            </div>
            <div class="content">
                <div class="text">Invalid Products</div>
                <div class="">{{ $invalidProductsCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">comment</i>
            </div>
            <div class="content">
                <div class="text">Reviews</div>
                <div class="">{{ $reviewCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">people</i>
            </div>
            <div class="content">
                <div class="text">sellers</div>
                <div class="">{{ $supplierCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-deep-purple hover-expand-effect">
            <div class="icon">
                <i class="material-icons">shopping_cart</i>
            </div>
            <div class="content">
                <div class="text">Deals</div>
                <div class="">{{ $dealCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-teal hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person</i>
            </div>
            <div class="content">
                <div class="text">Customers</div>
                <div class="">{{ $customerCount }}</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>Deals Activities</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <canvas id="dealActivityChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="block-header">
            <h2>Welcome Back Authenticator</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">check_circle</i>
                </div>
                <div class="content">
                    <div class="text">Valid Products</div>
                    <div class="">{{ $validProductsCount }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">cancel</i>
                </div>
                <div class="content">
                    <div class="text">Invalid Products</div>
                    <div class="">{{ $invalidProductsCount }}</div>
                </div>
            </div>
        </div>
    @endauth
@endsection
@auth('admin')
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('dealActivityChart').getContext('2d');
        var dealActivityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!}, // Labels from controller
                datasets: [{
                    label: 'Deals per Day',
                    data: {!! json_encode($dealActivityData) !!}, // Data from controller
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
@endauth
