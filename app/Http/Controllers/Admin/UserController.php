<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }


    public function create()
    {
        $roles = User::getRoles();
        return view('admin.user.create', compact('roles'));
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();

//        $password = Str::random(10);
//        Mail::to($data['email'])->send(new PasswordMail($password));

        $data['password'] = Hash::make($data['password']);
        User::firstOrCreate(['email'=>$data['email']],$data);
        return redirect()->route('admin.user.index');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = User::getRoles();
        return view('admin.user.edit', compact('user','roles'));
    }


    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return view('admin.user.show', compact('user'));

    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
