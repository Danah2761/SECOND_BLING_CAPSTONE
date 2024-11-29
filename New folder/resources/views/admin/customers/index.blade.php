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
                        <i class="material-icons">person</i> Customers
                    </a>
                </li>
            </ol>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->customer_id }}</td>
                            <td>{{ $customer->full_name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <!-- View Shipment Details Button -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#shipmentModal{{ $customer->customer_id }}">
                                    View Shipment Details
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Structure -->
                        <div class="modal fade" id="shipmentModal{{ $customer->customer_id }}" tabindex="-1" role="dialog" aria-labelledby="shipmentModalLabel{{ $customer->customer_id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="shipmentModalLabel{{ $customer->customer_id }}">Shipment Details for {{ $customer->full_name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if($customer->shipmentInfo)
                                            <p><strong>Address:</strong> {{ $customer->shipmentInfo->address }}</p>
                                            <p><strong>City:</strong> {{ $customer->shipmentInfo->city }}</p>
{{--                                            <p><strong>State:</strong> {{ $customer->shipmentInfo->state }}</p>--}}
                                            <p><strong>Postal Code:</strong> {{ $customer->shipmentInfo->postal_code }}</p>
                                            <p><strong>Country:</strong> {{ $customer->shipmentInfo->country }}</p>
                                            <p><strong>Phone:</strong> {{ $customer->shipmentInfo->phone }}</p>
                                        @else
                                            <p>No shipment information available for this customer.</p>
                                        @endif
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
