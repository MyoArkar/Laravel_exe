<?php

namespace App\Repositories\Article;

interface ArticleRepositoryInterface
{
    public function index();

    public function store($data);

    public function show($id);
}