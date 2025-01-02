<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements  UserRepositoryInterface
{
    public function index()
    {
        $users =  User::all();

        return $users;
    }

    public function store($data)
    {
        return  User::create($data);
    }

    public function show($id)
    {
        return  User::with('roles')->find($id);
    }

    
}