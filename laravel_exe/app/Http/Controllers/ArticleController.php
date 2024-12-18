<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = [
            [
                "id" => 1,
                "title" => "article one"
            ],
            [
                "id" => 2,
                "title" => "article two"
            ],
            [
                "id" => 3,
                "title" => "article three"
            ],
            [
                "id" => 4,
                "title" => "article four"
            ],
            [
                "id" => 5,
                "title" => "article five"
            ]
        ];
        return view('articles.index', [
            'articles' => $articles
            ]);
    }
}
