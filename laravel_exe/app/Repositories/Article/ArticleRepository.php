<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Repositories\Article\ArticleRepositoryInterface;

class ArticleRepository implements  ArticleRepositoryInterface
{
    public function index()
    {
        $articles =  Article::all();

        return $articles;
    }

    public function store($data)
    {
        return  Article::create($data);
    }

    public function show($id)
    {
        return  Article::find($id);
    }
}