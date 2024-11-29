@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="header">
            <ol class="breadcrumb breadcrumb-col-cyan">
                <li>
                    <a href="{{route('seller.home')}}">
                        <i class="material-icons">home</i> Home
                    </a>
                </li>
                <li>
                    <a href="{{route('seller.products.index')}}">
                        <i class="material-icons">shopping_basket</i> Products
                    </a>
                </li>
                <li class="active">
                    <i class="material-icons">edit</i> Edit
                </li>
            </ol>
            <ul class="header-dropdown m-r--5">
                <li class="">
                    <a href="{{ route('seller.products.index') }}"
                       class="btn btn-danger text-white btn-circle waves-effect waves-circle waves-float">
                        <i class="material-icons text-white">chevron_right</i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="body">
            <form action="{{ route('seller.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('seller.products.form')
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </div>
    </div>
@endsection
