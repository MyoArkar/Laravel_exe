<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            
            [
                "id" => 1,
                "category_id" => 1,
                "name" => "Article1",
                "description" => "This is the first article",
            ],
            [
                "id" => 2,
                "category_id" => 2,
                "name" => "Article2",
                "description" => "This is the second article",
            ],
            [
                "id" => 3,
                "category_id" => 3,
                "name" => "Article3",
                "description" => "This is the third article",
            ],
            [
                "id" => 4,
                "category_id" => 4,
                "name" => "Article4",
                "description" => "This is the fourth article",
            ],
            [
                "id" => 5,
                "category_id" => 5,
                "name" => "Article5",
                "description" => "This is the fifth article",
            ]
           
        ];

        foreach($articles as $article)
        {
            Article::create($article);
        }
    }
}
