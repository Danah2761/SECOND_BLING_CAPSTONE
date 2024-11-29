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
                        <i class="material-icons">rate_review</i> Reviews
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
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Review Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->review_id }}</td>
                            <td>{{ optional($review->customer)->full_name }}</td>
                            <td>{{ optional($review->product)->product_name }}</td>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->comment }}</td>
                            <td>{{ $review->review_date }}</td>
                            <td>
                                <a href="#" onclick="confirmAction('Are you sure want to delete?', 'form{{$review->review_id}}')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">delete</i>
                                </a>
                                <form id="form{{$review->review_id}}" action="{{ route('admin.reviews.destroy', $review->review_id) }}" method="POST" style="display:inline-block;">
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
