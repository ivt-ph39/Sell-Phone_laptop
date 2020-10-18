<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Comment;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function infoUser($value)
    {
        return Auth::user()->$value;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = [
            'comments'  => Comment::all(),
            'titlePage' => 'List Comment',
            'nameAdmin' => ucwords($this->infoUser('name'))
        ];
        return view('admin.comment.list', $data);
    }

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

