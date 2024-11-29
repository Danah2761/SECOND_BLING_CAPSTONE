@extends('admin.layouts.app')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <ol class="breadcrumb breadcrumb-col-cyan">
                        <li>
                            <a href="{{ route('admin.home') }}">
                                <i class="material-icons">home</i> Home
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                                <i class="material-icons">layers</i> Authenticators
                            </a>
                        </li>
                    </ol>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <a href="{{ route('admin.authenticators.create') }}"
                               class="btn btn-primary text-white btn-circle waves-effect waves-circle waves-float">
                                <i class="material-icons text-white">add</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>ID Number</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($authenticators as $index => $authenticator)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $authenticator->username }}</td>
                                    <td>{{ $authenticator->email }}</td>
                                    <td>{{ $authenticator->phone }}</td>
                                    <td>{{ $authenticator->id_number }}</td>
                                    <td>{{ $authenticator->address }}</td>
                                    <td>
                                        <a href="{{ route('admin.authenticators.edit', $authenticator->authenticator_id) }}" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="#" onclick="confirmAction('Are you sure you want to delete?', 'form{{ $authenticator->authenticator_id }}')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                        <form id="form{{ $authenticator->authenticator_id }}" action="{{ route('admin.authenticators.destroy', $authenticator->authenticator_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
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
