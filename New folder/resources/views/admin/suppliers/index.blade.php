@extends('admin.layouts.app')

@section('content')
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
                        <i class="material-icons">person</i> Sellers
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
                        <th> Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($suppliers as $index=>$supplier)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $supplier->fullName }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->company_phone }}</td>
                            <td>
                                @if($supplier->status === 'blocked')
                                    <span class="text-danger">blocked</span>
                                @else
                                    <span class="text-success">un blocked</span>
                                @endif
                            </td>
                            <td>
{{--                                <form action="{{ route('admin.suppliers.toggleStatus', $supplier->seller_id) }}" method="POST" style="display:inline-block;">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">--}}
{{--                                        @if($supplier->status === 'blocked')--}}
{{--                                            <i class="material-icons">lock_open</i>--}}
{{--                                        @else--}}
{{--                                            <i class="material-icons">lock</i>--}}
{{--                                        @endif--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                                <a href="#" onclick="confirmActionLock('{{$supplier->status === 'blocked' ? 'Unblock' : 'Block'}}', 'form{{$supplier->seller_id}}')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                    @if($supplier->status === 'blocked')
                                        <i class="material-icons">lock_open</i>
                                    @else
                                        <i class="material-icons ">lock</i>
                                    @endif
                                </a>
                                <form id="form{{$supplier->seller_id}}" action="{{ route('admin.suppliers.toggleStatus', $supplier->seller_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                </form>

                                <button type="button" class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="modal" data-target="#supplierModal{{ $supplier->seller_id }}">
                                    <i class="material-icons">visibility</i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal for supplier details -->
                        <div class="modal fade" id="supplierModal{{ $supplier->seller_id }}" tabindex="-1" role="dialog"
                             aria-labelledby="supplierModalLabel{{ $supplier->seller_id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="supplierModalLabel{{ $supplier->seller_id }}">Supplier Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Full Name:</strong> {{ $supplier->fullName }}</p>
                                        <p><strong>Email:</strong> {{ $supplier->email }}</p>
                                        <p><strong>Phone:</strong> {{ $supplier->company_phone }}</p>
                                        <p><strong>Address:</strong> {{ $supplier->company_address }}</p>
                                        <p><strong>Company:</strong> {{ $supplier->company_name }}</p>
                                        <p><strong>Status:</strong>  @if($supplier->status === 'blocked')
                                                <span class="text-danger">blocked</span>
                                            @else
                                                <span class="text-success">un blocked</span>
                                            @endif</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
