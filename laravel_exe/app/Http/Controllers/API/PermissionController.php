<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $permissions = Permission::all();
       
       return $this->success($permissions, "Permissions Retrived Successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        $permission = Permission::create([
            'name' => $request->name,
        ]);

        if($request->has('roles')){
            $permission->syncRoles($request->roles);
        }
        return $this->success($permission, "Permission Created Successfully", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);

        if(!$permission){
            return $this->error('Permission Not Found', null, 404);
        }
        
        return $this->success($permission, "Permission Retrived Successfully", 200);
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

        $permission = Permission::find($id);
        $permission->update([
            'name' => $request->name,
        ]);
        if($request->has('roles')){
            $permission->syncRoles($request->roles);
        }
        return $this->success($permission, "Permission Updated Successfully", 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);

        if(!$permission){
            return $this->error('Permission Not Found', null, 404);
        }

        $permission->delete();

        return $this->success(null, "Permission Deleted Successfully", 204);
    }
}
