@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="header">
            <ol class="breadcrumb breadcrumb-col-cyan">
                <li>
                    <a href="{{ route('admin.home') }}">
                        <i class="material-icons">home</i> Home
                    </a>
                </li>
                <li class="active">
                    <i class="material-icons">shopping_basket</i> Checking Products
                </li>
            </ol>
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
                        <th>Verification</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $index => $product)
                        @if(!$product->checked)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img style="height: 100px; width: 100px;" src="{{ $product->image_path }}" class="img-thumbnail"></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ optional($product->category)->category_name }}</td>
                                <td>SAR {{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td>
                                    @if ($product->checked && $product->checked->authenticity_status == 'valid')
                                        <span class="badge bg-success">Valid</span>
                                    @elseif ($product->checked && $product->checked->authenticity_status == 'invalid')
                                        <span class="badge bg-danger">Invalid</span>
                                    @else
                                        <span class="badge bg-warning">In Progress</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.products_check.check', $product->product_id) }}" class="btn btn-success btn-circle" data-toggle="modal" data-target="#checkProductModal{{ $product->product_id }}">
                                        <i class="material-icons">check</i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Modal for Product Check -->
                            <div class="modal fade" id="checkProductModal{{ $product->product_id }}" tabindex="-1" role="dialog" aria-labelledby="checkProductLabel{{ $product->product_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.products_check.updateStatus', $product->product_id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="checkProductLabel{{ $product->product_id }}">
                                                    <i class="material-icons">check_circle</i> Product Verification: <strong>{{ $product->product_name }}</strong>
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div  class="modal-body">
                                                <!-- Product Info Card -->
                                                <div class="card  mb-4">
                                                    <div style="padding: 30px;" class="card-header text-center p-3 bg-light">
                                                        <strong>Product Information</strong>
                                                    </div>
                                                    <div style="padding: 30px;" class="card-body p-4">
                                                        <div class="text-center mb-3">
                                                            <img style="height: 200px; width: 200px;" src="{{ $product->image_path }}" class="img-thumbnail">
                                                            <br>
                                                            <a href="{{ $product->image_path }}" target="_blank" class="btn btn-outline-primary mt-3">
                                                                <i class="fa fa-eye"></i> Open Image
                                                            </a>
                                                        </div>
                                                        <p><strong>Category:</strong> {{ optional($product->category)->category_name }}</p>
                                                        <p><strong>Seller:</strong> {{ optional($product->supplier)->fullName }}</p>
                                                        <p><strong>Price:</strong> SAR {{ number_format($product->price, 2) }}</p>
                                                        <p><strong>Description:</strong> {!! $product->description !!}</p>
                                                    </div>
                                                </div>

                                                <!-- Authenticity Status Section -->
                                                <div class="card mb-4">
                                                    <div style="padding: 30px;" class="card-header p-3 bg-light">
                                                        <strong>Authenticity Status</strong>
                                                    </div>
                                                    <div style="padding: 30px;" class="card-body p-4">
                                                        <div class="form-group">
                                                            <label for="authenticity_status" class="font-weight-bold">Choose Status:</label><br>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="authenticity_status_valid_{{ $product->product_id }}" name="authenticity_status" class="custom-control-input" value="valid" {{ $product->checked && $product->checked->authenticity_status == 'valid' ? 'checked' : '' }}>
                                                                <label class="custom-control-label text-success" for="authenticity_status_valid_{{ $product->product_id }}">
                                                                    <i class="fa fa-check-circle"></i> Valid
                                                                </label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="authenticity_status_invalid_{{ $product->product_id }}" name="authenticity_status" class="custom-control-input" value="invalid" {{ $product->checked && $product->checked->authenticity_status == 'invalid' ? 'checked' : '' }}>
                                                                <label class="custom-control-label text-danger" for="authenticity_status_invalid_{{ $product->product_id }}">
                                                                    <i class="fa fa-times-circle"></i> Invalid
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Notes Section -->
                                                <div class="card mb-4">
                                                    <div style="padding: 30px;" class="card-body p-4">
                                                        <div class="form-group">
                                                            <label for="notes" class="font-weight-bold">Add Notes (Optional):</label>
                                                            <textarea style="border: 1px solid #767676;" name="notes" class="form-control" rows="3" placeholder="Enter any notes here...">{{ $product->checked->notes ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-save"></i> Update Status
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    <i class="fa fa-times"></i> Close
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
