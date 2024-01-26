<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Membuat Function Dengan Paginate(10), Artinya hanya menampilkan 10 data

    // public function index() {

    //     $users = \App\Models\User::paginate(10);
    //     return view('pages.users.index', compact('users'));

    // }

    // Function Search
    public function index(Request $request)
    {
        $users = DB::table('users')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%'.$name.'%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    // Function Create
    public function create()
    {
        return view('pages.users.create');
    }

    // Function Store, Untuk mengirimkan data yang telah dibuat ke database
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        \App\Models\User::create($data);
        return redirect()->route('users.index')->with('success', 'User successfully created');
    }

    // Function mengarahkan ke page edit
    public function edit($id) {
        $user = \App\Models\User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    // Function untuk melakukan perubahan data
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User successfully updated');
    }

    // Function untuk delete data
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User successfully deleted');
    }
}
