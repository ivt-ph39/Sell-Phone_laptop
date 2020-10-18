<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Comment $comment, User $user)
    {
        if ($request->id) {
            $user = $user->find($request->id);
            $data = [
                'name'          => $user->name,
                'email'         => $user->email,
                'phone'         => $user->phone,
                'content'       => $request->content,
                'product_id'    => $request->product_id,
                'user_id'       => $request->id
            ];
            $comment = $comment->create($data);
        } else {
            $data = $request->all();
            $comment = $comment->create($data);
        }

        if ($comment) {
            return response()->json([
                'success' => true,
                'dataComment' => [
                    'name'    => $comment->name,
                    'content' => $comment->content,
                    'id'      => $comment->id
                ]
            ], 200);
        } else {
            return response()->json([
                'error' => true,
            ], 200);
        }
    }
}