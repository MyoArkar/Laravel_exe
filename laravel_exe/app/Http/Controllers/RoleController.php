<?php

namespace App\Http\Controllers;

use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->middleware('auth');
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {  
        $roles = $this->roleRepository->index();
        
        return view('roles.index', compact('roles'));
    }

    public function create()
    {   
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }
    public function store(Request $request)
    {   
        $data = $request->validate(
            [
                'name' => 'required|string',
            ]
        );

        $role = $this->roleRepository->store($data);

        if($request->has('permissions')){
           $role->syncPermissions($request->permissions);
        }
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = $this->roleRepository->show($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }
    public function update(Request $request)
    {   
        $data = $request->validate(
            [
                'name' => 'required|string',
            ]
        );

        $role = $this->roleRepository->show($request->id);
        $role->update($data);
        if($request->has('permissions')){
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('roles.index');
    }
    public function delete(Request $request)
    {
        $role = $this->roleRepository->show($request->id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
