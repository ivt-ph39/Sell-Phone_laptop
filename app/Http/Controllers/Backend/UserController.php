<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Model\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function infoUser($value)
    {
        return Auth::user()->$value;
    }


    public function index(Request $request)
    {
        if (isset($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        if (!empty($search)) {
            $users = User::where('name', 'like', "%$search%")->paginate(3);
        } else {
            $users = User::paginate(3);
        }
        $titlePage      = 'Danh sách Người Dùng';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'users' => $users,
            'trashed' => false
        ];
        return view('admin.user.list', $data);
    }

    public function onlyTrashed()
    {
        $users = User::onlyTrashed()->paginate(1);
        $titlePage      = 'Danh sách Người Dùng Đã Soft Delete';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'users' => $users,
            'trashed' => true
        ];
        return view('admin.user.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $titlePage      = 'Thêm người dùng';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'roles' => $roles
        ];
        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->except('role_id');
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if (!empty($user)) {
            $user->roles()->attach($request->role_id);
        }
        return redirect()->route('admin.user.list')->with('message', 'Đã thêm thành công nhân viên');
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
    public function edit(User $user)
    {
        $roles = Role::all();
        $roleChecked = $user->roles()->get();
        $titlePage      = 'Chỉnh Sửa Người Dùng';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'user' => $user,
            'roles' => $roles,
            'roleChecked' => $roleChecked,
        ];
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->role_id);
        return redirect()->route('admin.user.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //check don hag cua nguoi dung
        // check trang thai don hang
        // order don hang
        // check delete

        $rs = $user->delete();
        if ($rs) {
            return redirect()->route('admin.user.list')->with('message', 'Đã xóa mềm thành công');
        }
        return redirect()->route('admin.user.list')->with('message', 'Lỗi không xóa được');
    }

    public function checkOrder()
    {
        // kiem tra don hang cua khach hang 
    }

    public function restore($id)
    {

        User::withTrashed()->find($id)->restore();
        return redirect()->route('admin.user.list');
    }

    public function hardDelete($id)
    {
        User::withTrashed()->find($id)->forceDelete();
        return redirect()->route('admin.user.onlyTrashed');
    }
}