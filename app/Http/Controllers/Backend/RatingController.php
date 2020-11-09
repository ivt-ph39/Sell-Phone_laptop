<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Rating $rating)
    {
        $rating = $rating->create($request->all());
        // dd($rating->with(['user'])->find($request->user_id));
        if ($rating) {
            return response()->json([
                'success' => true,
                'rating'  => [
                    'id'        => $rating->id,
                    'content'   => $rating->content,
                    'star'      => $rating->star,
                    'name_user' => ucwords($rating->user->name),
                    'date'      => date_format($rating->created_at, "Y/m/d H:m")
                ]
            ], 200);
        }
    }
}