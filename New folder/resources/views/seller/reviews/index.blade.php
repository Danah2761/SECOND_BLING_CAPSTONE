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
                        <i class="material-icons">rate_review</i>My Reviews
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
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $index=>$review)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ optional($review->product)->product_name }}</td>
                            <td>{{ optional($review->customer)->full_name }}</td>
                            <td>
                               <strong>{{$review->rating}} / 5</strong>
                            </td>
                            <td>{{ $review->comment }}</td>
                            <td>{{ date('Y-m-d H:i A', strtotime($review->review_date)) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
