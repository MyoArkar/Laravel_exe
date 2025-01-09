<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $users = User::with('roles')->get();

      return $this->success($users, "Users Retrived Successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,except,id',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'roles' => 'required',
        ]);

        if($validator->fails()){
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $user->roles()->sync($request->roles);
        return $this->success($user, "User Created Successfully", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->find($id);

        if(!$user){
            return $this->error('User Not Found', null, 404);
        }

        return $this->success($user, "User Retrived Successfully", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'roles' => 'required',
        ]);

        if($validator->fails()){
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $user->roles()->sync($request->roles);
        return $this->success($user, "User Updated Successfully", 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return $this->error('User Not Found', null, 404);
        }
        
        $user->delete();

        return $this->success($user, "Article Deleted Successfully", 200);
    }
}
