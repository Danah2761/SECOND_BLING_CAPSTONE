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
                <li class="active">
                    <a href="#">
                        <i class="material-icons">shopping_basket</i> Products
                    </a>
                </li>
            </ol>
            <ul class="header-dropdown m-r--5">
                <li class="">
                    <a href="{{ route('seller.products.create') }}"
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
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
{{--                    <th>Stock</th>--}}
                    <th>Status</th>
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                @foreach($products as $index=>$product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><img style="height: 100px;
    width: 100px;" src="{{$product->image_path}}" class="img-thumbnail"></td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ optional($product->category)->category_name }}</td>
                        <td>{{ $product->price }}</td>
{{--                        <td>{{ $product->stock_quantity }}</td>--}}
                        <td>
                            Ready To Be Shipped
                        </td>
                        <td>


                            <a href="{{ route('seller.products.edit', $product->product_id) }}" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="#" onclick="confirmAction('Are you sure want to delete?', 'form{{$product->product_id}}')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                <i class="material-icons">delete</i>
                            </a>
                            <form id="form{{$product->product_id}}" action="{{ route('seller.products.destroy', $product->product_id) }}" method="POST" style="display:inline-block;">
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
@endsection
