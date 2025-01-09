<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return $this->success($roles, "Roles Retrived Successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
           'name' => 'required',
       ]);

       if($validator->fails()){
           return $this->error('Validation Error', $validator->errors(), 422);
       }

         $role = Role::create([
              'name' => $request->name,
         ]);

            return $this->success($role, "Role Created Successfully", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);

        if(!$role){
            return $this->error('Role Not Found', null, 404);
        }

        return $this->success($role, "Role Retrived Successfully", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
        ]);

        return $this->success($role, "Role Updated Successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if(!$role){
            return $this->error('Role Not Found', null, 404);
        }
        $role->delete();

        return $this->success(null, "Role Deleted Successfully", 204);
    }
}
