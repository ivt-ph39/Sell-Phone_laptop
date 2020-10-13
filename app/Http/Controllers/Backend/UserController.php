<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
        if(isset($request->search)){
            $search = $request->search;
        }else{
            $search = '';
        }
        
        if(!empty($search)){
            $users = User::where('name', 'like', "%$search%")->get();;
        }else{
            $users = User::all();
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

    public function onlyTrashed(){
        $users = User::onlyTrashed()->get();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user->delete();
        return redirect()->route('admin.user.list');
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