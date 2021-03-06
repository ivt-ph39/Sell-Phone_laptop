<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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
        $roles = Role::latest()->paginate(4);
        $titlePage      = 'Danh sách Vai Trò';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'roles' => $roles,
        ];
        return view('admin.role.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionParents = Permission::where('parent_id', 0)->get();
        $titlePage      = 'Thêm Vai Trò';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'permissionParents' => $permissionParents
        ];
        return view('admin.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]*$/',
            'description' => 'required'
        ],[
            'name.required' => 'Không được để trống',
            'name.regex' => 'Không đúng định dạng ex: adminSystem | admin',
            'description.required' => 'Không được để trống',
        ]);
        try {
            DB::beginTransaction();
            $data = $request->except('permission_id');
            $role = Role::create($data);

            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('admin.role.list')->with('message', 'Tạo thành công');
        } catch (Exception $e) {
            DB::rollback();
            echo "Error : " . $e->getMessage();
        }
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
    public function edit(Role $role)
    {
        $permissionParents = Permission::where('parent_id', 0)->get();
        $permissionChecked = $role->permissions()->get();
        $titlePage      = 'Chỉnh Sửa Vai Trò';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'role'        => $role,
            'permissionParents' => $permissionParents,
            'permissionChecked' => $permissionChecked,
        ];
        return view('admin.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]*$/',
            'description' => 'required'
        ],[
            'name.required' => 'Không được để trống',
            'name.regex' => 'Không đúng định dạng ex: adminSystem | admin',
            'description.required' => 'Không được để trống',
        ]);
        try {
            $data = $request->except('permission_id');
            $rs = $role->update($data);
            if ($rs) {
                $role->permissions()->sync($request->permission_id);
                return redirect()->route('admin.role.list')->with('message', 'Cập nhập thành công');
            }
        } catch (\Throwable $th) {
            throw $th;
            echo $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $rs = $role->delete();
        if($rs){
            return redirect()->route('admin.role.list')->with('message', 'Xóa thành công');
        }
        return redirect()->route('admin.role.list')->with('message', 'Xóa không thành công');
    }
}