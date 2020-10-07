<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;

use App\Components\RecursiveCategory;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function infoUser($value)
    {
        return Auth::guard('manager_admin')->user()->$value;
    }
    public function index()
    {
        $categories     = Category::orderBy('parent_id')->get();
        $titlePage      = 'Danh sách danh mục';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('adminName')),
            'categories'  => $categories
        ];
        return view('admin.category.list', $data);
    }

    public function create(Category $category)
    {
        $categories     = $category->all();

        $recursive      = new RecursiveCategory($categories);

        $htmlOption     = $recursive->recursiveCategory($parent_id = null);

        $data = [
            'nameAdmin'   => ucwords($this->infoUser('adminName')),
            'categories'  => $categories,
            'htmlOption'  => $htmlOption
        ];

        return view('admin.category.create', $data);
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category;
        if ($request->image) {
            $image = $this->storeFile($request->image);
        }

        $data = [
            'name'        => ucwords($request->name),
            'parent_id'      => $request->parent_id,
            'icon'        => $request->icon,
            'image'       => (isset($image)) ? $image : null,
            'active'      => ($request->active) ? 1 : 0,
            'create_by'   => $this->infoUser('id')
        ];
        $create_cate =  $category->create($data);

        if ($create_cate) return redirect()->to(route('admin.category.list'));
    }

    public function edit($id)
    {

        $category       = Category::find($id);

        $categories     = Category::all();
        $recursive      = new RecursiveCategory($categories);

        $htmlOption     = $recursive->recursiveCategory($category->parent_id['id']);
        $data = [
            'titlePage'   => 'Edit Danh Mục',
            'category'    => $category,
            'nameAdmin'   => ucwords($this->infoUser('adminName')),
            'htmlOption'  => $htmlOption
        ];

        return view('admin.category.edit', $data);
    }


    public function update(CategoryUpdateRequest $request, $id)
    {
        $category =   Category::find($id);

        $dataUpdate = [
            'name'        => ucwords($request->name),
            'icon'        => $request->icon,
            'active'      => ($request->active) ? 1 : 0,
            'update_by'   => $this->infoUser('id')
        ];

        $image = '';
        // Xử lí file ảnh.
        if (!isset($request->image)) {
            $image = '';
        } else {
            $image   = $this->storeFile($request->image); // trả về  tên đường dẫn đến file ảnh.
            $dataUpdate['image'] = $image;
        }
        $category->update($dataUpdate);
        return redirect()->route('admin.category.list');
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->forceDelete();
        return redirect()->route('admin.category.list');
    }
    //
    public function storeFile($file)
    {
        $namefile = time() . '-' . $file->getClientOriginalName();
        $p_avatar = $file->storeAs('public/category', $namefile);
        return str_replace('public/', 'storage/', $p_avatar);
    }
}