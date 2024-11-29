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
{{--                <li class="">--}}
{{--                    <a href="{{ route('supplier.products.create') }}"--}}
{{--                       class="btn btn-primary text-white btn-circle waves-effect waves-circle waves-float">--}}
{{--                        <i class="material-icons text-white">add</i>--}}
{{--                    </a>--}}
{{--                </li>--}}
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
                        <th>Stock</th>
                        <th>Verification?</th> <!-- New column -->
{{--                        <th>Actions</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $index=>$product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img style="height: 100px; width: 100px;" src="{{ $product->image_path }}" class="img-thumbnail"></td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ optional($product->category)->category_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock_quantity }}</td>

                            <!-- New Verification Column -->
                            <td>
                                @if($product->checked)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#authModal{{ $product->product_id }}">
                                        View Details
                                    </button>

                                    <!-- Modal for authenticity status details -->
                                    <div class="modal fade" id="authModal{{ $product->product_id }}" tabindex="-1" role="dialog" aria-labelledby="authModalLabel{{ $product->product_id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="authModalLabel{{ $product->product_id }}">Authentication Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Status:</strong> {{ ucfirst(optional($product->checked)->authenticity_status) }}</p>
                                                    <p><strong>Checked By:</strong> {{ optional(optional($product->checked)->authee)->username }}</p>
                                                    <p><strong>Authentication Date:</strong> {{ optional($product->checked)->authentication_date }}</p>
{{--                                                    <p><strong>Notes:</strong> {{ $product->checked->notes }}</p>--}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="badge badge-warning">In Progress</span>
                                @endif
                            </td>

{{--                            <td>--}}
{{--                                <a href="{{ route('supplier.products.edit', $product->product_id) }}" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">--}}
{{--                                    <i class="material-icons">edit</i>--}}
{{--                                </a>--}}
{{--                                <a href="#" onclick="confirmAction('Are you sure want to delete?', 'form{{ $product->product_id }}')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">--}}
{{--                                    <i class="material-icons">delete</i>--}}
{{--                                </a>--}}
{{--                                <form id="form{{ $product->product_id }}" action="{{ route('supplier.products.destroy', $product->product_id) }}" method="POST" style="display:inline-block;">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                </form>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
