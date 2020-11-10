<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BrandCreateRequest;
use App\Http\Requests\BrandEditRequest;

class BrandController extends Controller
{
    public function infoUser($value)
    {
        return Auth::user()->$value;
    }
    public function index(Brand $brand)
    {
        $brands     = $brand->get();
        $titlePage      = 'Danh Sách Thương Hiệu';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'brands'  => $brands
        ];
        return view('admin.brand.list', $data);
    }
    public function create()
    {
        $titlePage      = 'Thêm Thương Hiệu';

        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name'))
        ];
        return view('admin.brand.create', $data);
    }
    public function store(BrandCreateRequest $request, Brand $brand)
    {
        $path_avatar = $this->storeFile($request->avatar);

        $dataCreate = [
            'name'    => $request->name,
            'avatar'  => $path_avatar
        ];
        $brand->create($dataCreate);
        return redirect()->route('admin.brand.list')->with('success', 'Tạo mới thương hiệu thành công');
    }

    public function edit($id, Brand $brand)
    {
        $titlePage      = 'Thêm Thương Hiệu';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'brand'       => $brand->find($id)
        ];
        return view('admin.brand.edit', $data);
    }

    public function update($id, Brand $brand, BrandEditRequest $request)
    {
        // dd($request->all());
        $dataUpdate = [
            'name' => $request->name
        ];
        if ($request->avatar) {
            $dataUpdate = ['avatar' => $this->storeFile($request->avatar)];
        }

        $brand->find($id)->update($dataUpdate);
        return redirect()->route('admin.brand.list')->with('success', 'Update thương hiệu thành công');
    }
    public function delete($id)
    {
        dd($id);
    }
    public function storeFile($file)
    {
        $namefile = time() . '-' . $file->getClientOriginalName();
        $p_avatar = $file->storeAs('public/category', $namefile);
        return str_replace('public/', 'storage/', $p_avatar);
    }
}