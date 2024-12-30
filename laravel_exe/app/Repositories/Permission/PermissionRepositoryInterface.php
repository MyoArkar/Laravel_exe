<?php

namespace App\Repositories\Permission;

interface PermissionRepositoryInterface
{
    public function index();

    public function store($data);

    public function show($id);
    
    
}