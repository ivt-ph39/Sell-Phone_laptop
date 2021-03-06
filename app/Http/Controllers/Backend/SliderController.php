<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SliderCreateRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Model\Category;

class SliderController extends Controller
{
    public function infoUser($value)
    {
        return Auth::user()->$value;
    }
    public function index(Slider $slider, Category $category)
    {
        $titlePage      = 'Danh sách slider';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'sliders'     => $slider->all()
        ];
        return view('admin.slider.list', $data);
    }
    public function create()
    {
        $titlePage      = 'Thêm slider';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name'))
        ];
        return view('admin.slider.create', $data);
    }
    public function store(SliderCreateRequest $request, Slider $slider)
    {
        $data = [
            'name'   => $request->name,
            'active' => $request->active,
            'path'   => $this->storeFile($request->path)
        ];
        $slider->create($data);
        return redirect()->route('admin.slider.list')->with('success', 'Tạp Slide mới thành công');
    }
    public function edit($id, Slider $slider)
    {
        $slider = $slider->find($id);
        $titlePage      = 'Thêm slider';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'slider'      => $slider
        ];
        return view('admin.slider.edit', $data);
    }
    public function update($id, SliderUpdateRequest $request, Slider $slider)
    {
        $data = [
            'name'  => $request->name,
            'active' => $request->active
        ];
        if ($request->path) {
            $data['path'] = $this->storeFile($request->path);
        }
        $slider->find($id)->update($data);
        return redirect()->route('admin.slider.list')->with('success', 'Update slide mới thành công');
    }
    public function delete($id, Slider $slider)
    {
        $slider->find($id)->delete();
        return redirect()->route('admin.slider.list')->with('success', 'Đã xóa slide thành công');
    }
    public function storeFile($request)
    {
        $file = $request;
        $namefile = time() . $request->getClientOriginalName();
        $store_file =  $file->move('uploads/images/sliders', $namefile);
        $path_image = 'uploads/images/sliders/' . $namefile;
        return $path_image;
    }
}