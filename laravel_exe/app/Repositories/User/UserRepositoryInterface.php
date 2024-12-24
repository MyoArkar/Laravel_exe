<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function index();

    public function store($data);

    public function show($id);
    
    
}