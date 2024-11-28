<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // List all reviews
    public function index()
    {
        $reviews = Review::with(['customer', 'product', 'admin'])->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('successfully', 'Review deleted successfully');
    }
}
