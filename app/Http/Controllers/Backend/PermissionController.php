<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
        $permissionParents = Permission::where('parent_id', 0)->get();
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
        $permissionChildren = Permission::where('parent_id', $parent_id)->get();
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
    public function storeParent(Request $request)
    {
        dd($request->all());
        $data = $request->all();
        Permission::create($data);
        return redirect()->route('admin.permission.list');
    }

    public function storeChildren(Request $request)
    {
        $data = $request->all();
        $permission = Permission::create($data);
        return redirect()->route('admin.permission.listChildren', ['parent_id' => $permission->parent_id]);
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
    public function update(Request $request, Permission $permission)
    {
        $data = $request->all();
        $permission->update($data);
        return redirect()->route('admin.permission.listChildren', ['parent_id' => $permission->parent_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.permission.listChildren', ['parent_id' => $permission->parent_id]);
    }
}