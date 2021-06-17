<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::select('users.id', 'users.email', 'users.name', 'roles.role')
            ->join('roles', 'roles.id', '=', 'users.role_id')->get();
        $role = role::get();
        return view('admin.index', ['data_user' => $user, 'role' => $role]);
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
        $request->validate([
            'name' => 'required'
        ]);
        // dd($request->all());
        $role = role::find($request->role);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $role->users()->save($user);
        return redirect()->route('crud');
    }
    function message()
    {
        return "field required";
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
    public function edit($id)
    {
        $user = User::select('users.id', 'users.email', 'users.role_id', 'users.name', 'roles.role')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.id', '=', "{$id}")
            ->first();
        $role = role::get();
        return view('admin.editmodal', ['pilih_user' => $user, 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        User::where('id', $id)->update(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'role_id' => $request->role]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/crud');
    }
}
