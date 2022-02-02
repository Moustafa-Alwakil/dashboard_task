<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Store;
use App\Http\Requests\User\Update;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arr['users'] = User::query()->paginate();
        $arr['flag'] = 'users';
        return view('users.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['flag'] = 'users';
        return view('users.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $path = $request->file('image')->store(User::$storage, 'public');
        $image = Str::afterLast($path, '/');

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->title = $request->title;
        $user->specialty = $request->specialty;
        $user->image = $image;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $arr['user'] = $user;
        $arr['flag'] = 'users';
        return view('users.edit', $arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, User $user)
    {
        if ($request->file('image')) {
            Storage::delete('public/' . User::$storage . '/' . $user->image);
            $path = $request->file('image')->store(User::$storage, 'public');
            $image = Str::afterLast($path, '/');
            $user->image = $image;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->title = $request->title;
        $user->specialty = $request->specialty;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete('public/' . User::$storage . '/' . $user->image);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully');
    }
}
