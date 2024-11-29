@extends('admin.layouts.app')

@section('content')
    <div class="block-header">
        <h2>Top Selling Products Report</h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Top Selling Products</h2>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Total Sales</th>
                            <th>Total Revenue</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topProducts as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->total_sales }}</td>
                                <td><strong class="text-danger">SAR {{ number_format($product->total_revenue, 2) }}</strong></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
