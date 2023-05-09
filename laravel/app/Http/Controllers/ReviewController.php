<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        $review = new Review();
        $review->id_profile = $request->input('id_profile');
        $review->id_movies = $request->input('id_movies');
        $review->review = $request->input('review');
        $review->save();

        return response()->json(['message' => 'Review created successfully.']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_profile' => 'required',
            'review' => 'required',
        ]);

        $review = new Review();
        $review->id_profile = $request->input('id_profile');
        $review->id_movies = $request->input('id_movies');
        $review->review = $request->input('review');
        $review->save();

        return response()->json(['message' => 'Review created successfully.']);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.']);
    }
    public function show($id)
    {
        $review = Review::with('movie', 'profile')->findOrFail($id);
        return response()->json(['review' => $review]);
    }

    public function index(Request $request)
    {
        $reviews = Review::with('movie','profile')->get();
        return response()->json(['reviews' => $reviews]);
    }

}