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
                                <i class="material-icons">layers</i> Categories
                            </a>
                        </li>
                        <li class="active">

                        </li>
                    </ol>
                    <ul class="header-dropdown m-r--5">
                        <li class="">
                            <a href="{{ route('admin.categories.create') }}"
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
                                <th>Category Name</th>
                                <th>Category Stock </th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $index=>$category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ count($category->products) }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="#" onclick="confirmAction('Are you sure want to delete?', 'form{{$category->category_id}}')"  class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                        <form id="form{{$category->category_id}}" action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" style="display:inline-block;">
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
