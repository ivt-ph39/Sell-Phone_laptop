<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\EditContactRequest;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function infoUser($value)
    {
        return Auth::guard('manager_admin')->user()->$value;
    }
    public function index(Contact $contact)
    {
        $data = [
            'contacts'  => $contact->all(),
            'titlePage' => 'List Contact',
            'nameAdmin' => ucwords($this->infoUser('adminName'))
        ];
        return view('admin.contact.list', $data);
    }
    public function create()
    {
        $data = [
            'titlePage' => 'Add Contact',
            'nameAdmin' => ucwords($this->infoUser('adminName'))
        ];
        return view('admin.contact.create', $data);
    }
    public function store(CreateContactRequest $request, Contact $contact)
    {
        $data = $request->except('_token', 'active');
        if ($request->active) {
            $data['active'] = $request->active;
        } else {
            $data['active'] = '';
        }
        $contact->create($data);
        return Redirect()->route('admin.contact.list');
    }
    public function edit($id, Contact $contact)
    {
        $data = [
            'titlePage' => 'Edit Contact',
            'contact'   => $contact->find($id),
            'nameAdmin' => ucwords($this->infoUser('adminName'))
        ];
        return view('admin.contact.edit', $data);
    }
    public function update(EditContactRequest $request, Contact $contact, $id)
    {
        $data = $request->except('_token', 'active', '_method', 'id');
        if ($request->active) {
            $data['active'] = $request->active;
        } else {
            $data['active'] = '';
        }
        $contact->find($id)->update($data);

        return Redirect()->route('admin.contact.list');
    }
    public function delete($id, Contact $contact)
    {
        $contact->find($id)->delete();
        return Redirect()->route('admin.contact.list');
    }
}