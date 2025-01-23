<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);
        $product=Product::find($request->product_id);
        $review = $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json($review, 201);
    }



    public function update(Request $request, Review $review)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);
        if(auth()->id()!=$review->user_id){
            return response()->json(['error' => 'cant update this review'], 403);
        }
        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json($review);
    }

    public function destroy($id)
    {
        $review=Review::find($id);
        if (!$review) {
            return response()->json(['error' => 'Review not found'], 404);
        }
        if(auth()->id()!=$review->user_id){
            return response()->json(['error' => 'cant delete this review'], 403);
        }
        $review->delete();
        return sendResponse(200,'Review deleted successfully',null);
    }
}
