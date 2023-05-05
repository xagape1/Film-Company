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
        $review->id_movie = $request->input('id_movie');
        $review->id_episode = $request->input('id_episode');
        $review->review = $request->input('review');
        $review->save();
        
        return redirect()->route('review.index');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_profile' => 'required',
            'review' => 'required',
        ]);
        
        $review = new Review();
        $review->id_profile = $request->input('id_profile');
        $review->id_movie = $request->input('id_movie');
        $review->id_episode = $request->input('id_episode');
        $review->review = $request->input('review');
        $review->save();
        
        return redirect()->route('review.index');
    }
    
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        
        return redirect()->route('review.index');
    }
    
    public function index(Request $request)
    {
        $reviews = Review::with('movie', 'episode', 'profile')->get();
        return view('reviews.index', ['reviews' => $reviews]);
    }
}