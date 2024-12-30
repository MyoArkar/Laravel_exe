<?php

namespace App\Repositories\Role;

use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function index()
    {
        $roles =  Role::with('permissions')->get();

        return $roles;
    }

    public function store($data)
    {
        return  Role::create($data);
    }

    public function show($id)
    {
        return  Role::with('permissions')->find($id);
    }
}