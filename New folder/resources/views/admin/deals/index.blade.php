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
                        <i class="material-icons">border_color</i> Deals
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
                        <th>Customer</th>
                        <th>Seller</th>
                        <th>Total Price</th>
                        <th>Deal Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deals as $index => $deal)
                        <tr>
                            <td>{{$deal->deal_id }}</td>
                            <td>{{ $deal->customer->fullName }}</td>
                            <td>{{ optional($deal->seller)->fullName }}</td>
                            <td>SAR {{ number_format($deal->total_price, 2) }}</td>
                            <td>{{ date('d M Y', strtotime($deal->deal_date)) }}</td>
                            <td>
                                @if($deal->deal_status == 'pending')
                                    <span class="badge badge-warning">{{ ucfirst($deal->deal_status) }}</span>
                                @elseif($deal->deal_status == 'shipped')
                                    <span class="badge badge-info">{{ ucfirst($deal->deal_status) }}</span>
                                @elseif($deal->deal_status == 'delivered')
                                    <span class="badge badge-success">{{ ucfirst($deal->deal_status) }}</span>
                                @elseif($deal->deal_status == 'canceled')
                                    <span class="badge badge-danger">{{ ucfirst($deal->deal_status) }}</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.deals.show', $deal->deal_id) }}" class="btn btn-primary btn-sm"> <i class="material-icons">remove_red_eye</i> View Invoice </a>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#changeStatusModal{{$deal->deal_id}}">  <i class="material-icons">edit</i> Change Status</button>
                            </td>
                        </tr>

                        <!-- Change Status Modal -->
                        <!-- Change Status Modal -->
                        <div class="modal fade" id="changeStatusModal{{$deal->deal_id}}" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel{{$deal->deal_id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="changeStatusModalLabel{{$deal->deal_id}}">Change Deal Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="fromUpdateStatus{{$deal->deal_id}}" action="{{ route('admin.deals.changeStatus', $deal->deal_id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="deal_status">Deal Status</label>

                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="deal_status" value="pending"
                                                           {{ $deal->deal_status == 'pending' ? 'checked' : '' }} id="status_pending_{{$deal->deal_id}}">
                                                    <label class="form-check-label" for="status_pending_{{$deal->deal_id}}">Pending</label>
                                                </div>

                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="deal_status" value="shipped"
                                                           {{ $deal->deal_status == 'shipped' ? 'checked' : '' }} id="status_shipped_{{$deal->deal_id}}">
                                                    <label class="form-check-label" for="status_shipped_{{$deal->deal_id}}">Shipped</label>
                                                </div>

                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="deal_status" value="delivered"
                                                           {{ $deal->deal_status == 'delivered' ? 'checked' : '' }} id="status_delivered_{{$deal->deal_id}}">
                                                    <label class="form-check-label" for="status_delivered_{{$deal->deal_id}}">Delivered</label>
                                                </div>

                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="deal_status" value="canceled"
                                                           {{ $deal->deal_status == 'canceled' ? 'checked' : '' }} id="status_canceled_{{$deal->deal_id}}">
                                                    <label class="form-check-label" for="status_canceled_{{$deal->deal_id}}">Canceled</label>
                                                </div>
                                            </div>

                                            <!-- Product List with Authentication Status -->
                                            <h5 class="mt-3">Products in Deal</h5>
                                            <ul class="list-group">
                                                @foreach($deal->dealItems as $item)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ optional($item->product)->product_name }}
                                                        <span>
                                        @if($item->product->checked && $item->product->checked->authenticity_status == 'valid')
                                                                <span class="badge badge-success bg-success">valid </span>
                                                            @else
                                                                <span class="badge badge-danger">invalid</span>
                                                            @endif
                                    </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update Status</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
