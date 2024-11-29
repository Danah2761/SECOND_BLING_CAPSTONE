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
                                <i class="material-icons">person</i> Admins
                            </a>
                        </li>
                    </ol>
                    <ul class="header-dropdown m-r--5">
                        <li class="">
                            <a href="{{ route('admin.admins.create') }}"
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
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($admins as $index=>$admin)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ ucfirst($admin->role) }}</td>
                                    <td>
                                        <a href="{{ route('admin.admins.edit', $admin->admin_id) }}" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        @if($admin->admin_id != auth('admin')->user()->admin_id)
                                        <a href="#" onclick="confirmAction('Are you sure want to delete?', 'form{{$admin->admin_id}}')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                        <form id="form{{$admin->admin_id}}" action="{{ route('admin.admins.destroy', $admin->admin_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
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
