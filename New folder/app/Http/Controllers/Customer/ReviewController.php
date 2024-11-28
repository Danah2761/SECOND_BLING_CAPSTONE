<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function addNewReview(Request $request)
    {
        $request->validate([
            'rate_review' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);
        Review::create([
            'customer_id' => auth('customer')->user()->customer_id,
            'product_id' => $request->product_id,
            'rating' => $request->rate_review,
            'comment' => $request->comment,
            'review_date' => now(),
        ]);
        return redirect()->back()->with('successfully', 'Review submitted successfully.');
    }

    // Delete a review
    public function deleteReview($id)
    {
        $review = Review::where('customer_id', auth('customer')->id())->findOrFail($id);

        if ($review) {
            $review->delete();
            return redirect()->back()->with('successfully', 'Review deleted successfully.');
        }

        return redirect()->back()->with('failed', 'Review not found.');
    }
}
