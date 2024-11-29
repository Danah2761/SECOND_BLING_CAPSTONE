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
                                <i class="material-icons">verified_user</i> Product Authentication Status Report
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
                                <th>Authenticity Status</th>
                                <th>Total Products</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($authStatusData as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucfirst($data->authenticity_status) }}</td>
                                    <td>{{ $data->total }}</td>
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
