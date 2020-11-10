<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Comment;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'comments'  => Comment::where('parent_id', 0)->paginate(4),
            'titlePage' => 'List Comment',
            'nameAdmin' => ucwords($this->infoUser('name'))
        ];
        return view('admin.comment.list', $data);
    }

    public function active(Comment $comment){
        // dd(str_replace(url('/'), '', url()->previous()));
        // $path=str_replace(url('/'), '', url()->previous());
        if($comment->active){ // show -> hiden
            $comment->update(['active' => 0]);
        }else{ $comment->update(['active' => 1]); }
        return redirect()->back();
    }

    public function showMessage(){
        $actives = Comment::where('active', 1)->get();
        if($actives){
            return response()->json([
                'count' => count($actives),
            ],200);
        }
        
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
    public function showReply($id){
        $data = [
            'comment'  => Comment::find($id),
            'titlePage' => 'Reply Comment',
            'nameAdmin' => ucwords($this->infoUser('name'))
        ];
        return view('admin.comment.reply', $data);
    }

    public function reply($id, Request $request){
        $client = Comment::find($id);
        $data = [
            'name' => $this->infoUser('name'),
            'phone' => $this->infoUser('phone'),
            'email' => $this->infoUser('email'),
            'content' => $request->content,
            'product_id' => $client->product_id,
            'parent_id' => $id
        ];
        try {
            DB::beginTransaction();
            Comment::create($data);
            $client->update(['status'=> 1] );
            DB::commit();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            DB::rollback();
        }
        return redirect()->route('admin.comment.list');
    }

    
  
  
}

