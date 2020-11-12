<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Model\Blog;
use App\Model\Blog_tag;
use CreateBlogsTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
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
        if (isset($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        if (!empty($search)) {
            $blogs = Blog::where('title', 'like', "%$search%")->latest()->paginate(5);
        } else {
            $blogs = Blog::latest()->paginate(5);
        }
        $data = [
            'titlePage'   => 'Danh Sách Blog',
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'blogs'  => $blogs
        ];
        return view('admin.blog.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'titlePage'   => 'Tạo Blog',
            'nameAdmin'   => ucwords($this->infoUser('name'))
        ];
        return view('admin.blog.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBlogRequest $request)
    {
        $thumbnailName = $request->file('thumbnail')->getClientOriginalName();
        $request->file('thumbnail')->move(public_path('/uploads/images/blogs/'), $thumbnailName);

        $data = [
            'title' => $request->title,
            'thumbnail' => $thumbnailName,
            'content' => $request->content,
            'status' => ($request->status == 'on') ? 1 : 0,
            'author' => $this->infoUser('name')
        ];
        $blog = Blog::create($data);
        foreach ($request->tag as $tag) {
            Blog_tag::create(['tag' => $tag, 'blog_id' => $blog->id]);
        }
        return redirect()->route('admin.blog.list')->with('message', 'Thêm bài viết thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $data = [
            'titlePage'   => 'Chỉnh Sửa Blog',
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'blog'  => $blog
        ];
        return view('admin.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBlogRequest $request, Blog $blog)
    {

        if ($request->has('thumbnail')) {
            $thumbnailName = $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->move(public_path('/uploads/images/blogs/'), $thumbnailName);
        }else{
            $thumbnailName = $blog->thumbnail;
        }
        $data = [
            'title' => $request->title,
            'thumbnail' => $thumbnailName,
            'content' => $request->content,
            'status' => ($request->status == 'on') ? 1 : 0,
            'author' => $this->infoUser('name')
        ];
        $blog->update($data);
        foreach ($request->tag as $tag) {
            Blog_tag::updateOrCreate(['tag' => $tag, 'blog_id' => $blog->id]);
        }
        return redirect()->route('admin.blog.list')->with('message', 'Cập nhập thành công bài viết');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $rs = $blog->delete();
        if($rs){
            return redirect()->route('admin.blog.list')->with('message', 'Xóa bài viết thành công');
        }
        return redirect()->route('admin.blog.list')->with('message', 'Xóa bài viết không thành công');
    }
}
