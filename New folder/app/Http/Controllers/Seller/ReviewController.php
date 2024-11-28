<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['product', 'customer'])
            ->where('seller_id', auth('seller')->user()->seller_id)->get();
        return view('seller.reviews.index', compact('reviews'));
    }
}
