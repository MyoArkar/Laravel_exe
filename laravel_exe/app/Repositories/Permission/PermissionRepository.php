<?php

namespace App\Repositories\Permission;

use Spatie\Permission\Models\Permission;

use App\Repositories\Permission\PermissionRepositoryInterface;

class PermissionRepository implements  PermissionRepositoryInterface
{
    public function index()
    {
        $permissions =  Permission::all();

        return $permissions;
    }

    public function store($data)
    {
        return  Permission::create($data);
    }

    public function show($id)
    {
        return Permission::with('roles')->find($id);
    }

    
}