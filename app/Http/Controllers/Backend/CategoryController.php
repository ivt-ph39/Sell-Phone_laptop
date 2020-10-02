<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;

use App\Components\RecursiveCategory;

use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function infoUser($value)
    {
        return Auth::guard('manager_admin')->user()->$value;
    }
    public function index()
    {
        $categories     = Category::orderBy('c_parent')->get();
        $titlePage      = 'Danh sách danh mục';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('adminName')),
            'categories'  => $categories
        ];
        return view('admin.category.list', $data);
    }

    public function create()
    {
        $categories     = Category::all();

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
        if ($request->c_image) {
            $c_image = $this->storeFile($request->c_image);
        }

        $data = [
            'c_name'        => ucwords($request->c_name),
            'c_parent'      => $request->c_parent,
            'c_icon'        => $request->c_icon,
            'c_image'       => $c_image,
            'c_active'      => ($request->c_active) ? 1 : 0,
            'c_create_by'   => $this->infoUser('id')
        ];

        $create_cate =  $category->create($data);

        // update total category child.
        if ($create_cate) {
            if ($request->c_parent != 0) {
                $this->plusTotalCateChild($request->c_parent);
            }
        }
        if ($create_cate) return redirect()->to(route('admin.category.list'));
    }

    public function edit($id)
    {

        $category       = Category::find($id);

        $categories     = Category::all();
        $recursive      = new RecursiveCategory($categories);

        $htmlOption     = $recursive->recursiveCategory($category->c_parent['id']);
        $data = [
            'titlePage'   => 'Edit Danh Mục',
            'category'    => $category,
            'nameAdmin'   => ucwords($this->infoUser('adminName')),
            'htmlOption'  => $htmlOption
        ];

        return view('admin.category.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'c_name' => "required|unique:categories,c_name,$id",
        ];
        $mess  = [
            'c_name.required' => 'Tên danh mục không được để trống',
            'c_name.unique' => 'Tên danh mục đã tônf tại',
        ];

        $this->validate($request, $rules, $mess);


        $category =   Category::find($id);

        $data = [
            'c_name'        => ucwords($request->c_name),
            'c_icon'        => $request->c_icon,
            'c_active'      => ($request->c_active) ? 1 : 0,
            'c_update_by'   => $this->infoUser('id')
        ];

        $c_image = '';
        // Xử lí file ảnh.
        if ($request->c_image == null) {
            $c_image = '';
        } else {
            $c_image   = $this->storeFile($request->c_image); // trả về  tên đường dẫn đến file ảnh.
            $data      = array_merge($data, ['c_image' => $c_image]);
        }

        $update_cate = $category->update($data);

        if ($update_cate) {
            if ($category->c_parent['id'] != $request->c_parent) {

                if ($request->c_parent == 0) {
                    $this->minusTotalCateChild($category->c_parent['id']);
                } else if ($category->c_parent['id'] == 0) {
                    $this->plusTotalCateChild($request->c_parent);
                } else {
                    $this->plusTotalCateChild($request->c_parent);
                    $this->minusTotalCateChild($category->c_parent['id']);
                }
            }
            $category->update(['c_parent' => $request->c_parent]);
        }
        return redirect()->to(route('admin.category.list'));
    }


    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category->c_parent['id'] != 0) {
            $c_parent = $category->c_parent['id'];
            $this->minusTotalCateChild($c_parent);
        }

        $category->delete();
        return back();
    }
    //
    public function storeFile($file)
    {
        $namefile = time() . '-' . $file->getClientOriginalName();
        $p_avatar = $file->storeAs('public/category', $namefile);
        return str_replace('public/', 'storage/', $p_avatar);
    }

    //
    public function plusTotalCateChild($id)
    {
        $cate_parent = Category::find($id);

        $total_child_of_cate_new = $cate_parent->total_cate_child++;

        $cate_parent->update(['total_cate_child', $total_child_of_cate_new]);
    }

    // 
    public function minusTotalCateChild($id)
    {
        $cate_parent = Category::find($id);

        $total_child_of_cate_new = $cate_parent->total_cate_child--;

        $cate_parent->update(['total_cate_child', $total_child_of_cate_new]);
    }
}