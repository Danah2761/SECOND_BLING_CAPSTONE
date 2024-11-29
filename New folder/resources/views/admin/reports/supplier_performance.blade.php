@extends('admin.layouts.app')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <ol class="breadcrumb breadcrumb-col-cyan">
                        <li>
                            <a href="{{route('admin.home')}}">
                                <i class="material-icons">home</i> Home
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                                <i class="material-icons">trending_up</i> Seller Performance Report
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Seller Name</th>
                                <th>Total Deals</th>
                                <th>Average Product Rating</th>
{{--                                <th>Valid Authentication %</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($supplierData as $index => $supplier)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $supplier['supplier_name'] }}</td>
                                    <td>{{ $supplier['total_deals'] }}</td>
                                    <td>{{ number_format($supplier['average_product_rating'], 2) }}</td>
{{--                                    <td>{{ number_format($supplier['valid_auth_percentage'], 2) }}%</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
