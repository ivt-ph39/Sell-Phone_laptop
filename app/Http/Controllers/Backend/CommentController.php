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
    public function index(Request $request)
    {
        if (isset($request->id)) {
            $id = $request->id;
        } else {
            $id = '';
        }
        if (isset($request->created_at)) {
            $created_at = date($request->created_at);
        } else {
            $created_at = '';
        }

        if (!empty($id) || !empty($created_at)) {
            $comments = Comment::where('parent_id', 0)
                                ->whereDate('created_at', '=', $created_at)
                                ->orwhere('id','=', $id)
                                ->latest()
                                ->paginate(3);
        } else {
            $comments = Comment::where('parent_id', 0)->latest()->paginate(3);
        }

        $data = [
            'comments'  => $comments,
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
        $status = Comment::where('status', 0)->get();
        if($status){
            return response()->json([
                'count' => count($status),
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
        $request->validate([
            'content' => 'required'
        ],
        [
            'content.required' => 'Không được để trống nội dung'
        ]);
        $client = Comment::find($id);
        $data = [
            'name' => $this->infoUser('name'),
            'phone' => $this->infoUser('phone'),
            'email' => $this->infoUser('email'),
            'content' => $request->content,
            'product_id' => $client->product_id,
            'parent_id' => $id,
            'status' => 1
        ];
            $rs = Comment::create($data);
            if(!empty($rs)){
                $client->update(['status' => 1]); // 0 chưa 1 rồi
                return redirect()->route('admin.comment.list')
                                    ->with('message', 'Đã trả lời cho comment khách hàng');
            }
            return redirect()->route('admin.comment.list')
            ->with('message', 'Lỗi comment cho khách hàng');
    }

    
  public function destroy(Comment $comment)
  {
    $rs = $comment->delete();
    if($rs){
        return redirect()->back()->with('message' , 'Đã xóa comment thành công');
    }
    return redirect()->back()->with('message' , 'Xóa comment không thành công!!!!');
  }
  
}

