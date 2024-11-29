@extends('admin.layouts.app')

@section('content')

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('admin.home')}}">
                                <i class="material-icons">home</i> Home
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.categories.index')}}">
                                <i class="material-icons">layers</i> Categories
                            </a>
                        </li>
                        <li class="active">
                            <i class="material-icons">add</i> Add New
                        </li>
                    </ol>
                    <ul class="header-dropdown m-r--5">
                        <li class="">
                            <a href="{{ route('admin.categories.index') }}"
                               class="btn btn-danger text-white btn-circle waves-effect waves-circle waves-float">
                                <i class="material-icons text-white">chevron_right</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form action="{{route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="row padding">
                            @include('admin.categories.form')
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn w-50 m-t-15 btn-primary waves-effect">
                                    <i class="material-icons">verified_user</i>
                                    Save Date
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
