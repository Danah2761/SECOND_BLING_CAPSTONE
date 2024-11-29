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
                                <i class="material-icons">bar_chart</i> Sales Summary Report
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
                                <th>Month</th>
                                <th>Total Deals</th>
                                <th>Total Revenue (SAR)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($salesData as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->month }}</td>
                                    <td>{{ $data->total_deals }}</td>
                                    <td>{{ number_format($data->total_revenue, 2) }}</td>
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
