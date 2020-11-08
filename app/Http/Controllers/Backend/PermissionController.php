<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePermissionChildrenRequest;
use App\Http\Requests\CreatePermissionRequest;
use App\Model\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
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
        $permissionParents = Permission::where('parent_id', 0)->latest()->paginate(5);
        $titlePage      = 'Danh Sách Quyền Cha';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'permissionParents' => $permissionParents,

        ];
        return view('admin.permission.list', $data);
    }

    public function indexChildren($parent_id)
    {
        $permissionParent = Permission::find($parent_id);
        $permissionChildren = Permission::where('parent_id', $parent_id)->latest()->paginate(5);
        $titlePage      = 'Danh Sách Quyền Con -- ';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'permissionChildren' => $permissionChildren,
            'permissionParent' => $permissionParent

        ];
        return view('admin.permission.listChildren', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent)
    {
        $permissionParents = Permission::where('parent_id', 0)->get();
        $titlePage      = 'Thêm Quyền';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'permissionParents' => $permissionParents,
            'parent' => $parent,
        ];
        return view('admin.permission.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeParent(CreatePermissionRequest $request)
    {
        $data = $request->all();
        Permission::create($data);
        return redirect()->route('admin.permission.list')
        ->with('message', 'Đã thêm quyền thành công');
    }

    public function storeChildren(CreatePermissionChildrenRequest $request)
    {
        $data = $request->all();
        $permission = Permission::create($data);
        return redirect()->route('admin.permission.listChildren', ['parent_id' => $permission->parent_id])
        ->with('message', 'Đã thêm quyền thành công');
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
    public function edit(Permission $permission)
    {
        $permissionParents = Permission::where('parent_id', 0)->get();
        $titlePage      = 'Chỉnh sửa Quyền';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'flagParent'  => ($permission->parent_id == 0) ? true : false,
            'permission'  => $permission,
            'permissionParents' => $permissionParents
        ];
        return view('admin.permission.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateChildren(CreatePermissionChildrenRequest $request, Permission $permission)
    {
        $data = $request->all();
        $rs = $permission->update($data);
        if($rs){
            return redirect()->route('admin.permission.listChildren', ['parent_id' => $permission->parent_id])
            ->with('message', 'Đã cập nhập quyền thành công');
        }
            return redirect()->route('admin.permission.listChildren', ['parent_id' => $permission->parent_id])
            ->with('message', 'Chưa cập nhập quyền thành công!!');
    }

    public function updateParent(CreatePermissionRequest $request, Permission $permission)
    {
        $data = $request->all();
        $rs = $permission->update($data);
        if($rs){
            return redirect()->route('admin.permission.list')
            ->with('message', 'Đã cập nhập quyền thành công');
        }
            return redirect()->route('admin.permission.list')
            ->with('message', 'Chưa cập nhập quyền thành công!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $rs = $permission->delete();
        if($rs){
            return redirect()->route('admin.permission.list', ['parent_id' => $permission->parent_id])
            ->with('message', 'Đã xóa 1 quyền cha thành công');
        }
        return redirect()->route('admin.permission.list', ['parent_id' => $permission->parent_id])
        ->with('message', 'Xóa không thành công');
    }

    public function destroyChildren(Permission $permission)
    {
        $rs =$permission->delete();
        if($rs){
            return redirect()->route('admin.permission.listChildren', ['parent_id' => $permission->parent_id])
            ->with('message', 'Đã xóa 1 quyền con thành công');
        }
        return redirect()->route('admin.permission.listChildren', ['parent_id' => $permission->parent_id])
        ->with('message', 'Xóa không thành công');
    }
}