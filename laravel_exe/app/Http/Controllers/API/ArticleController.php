<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ArticleController extends BaseController
{   
    public function __construct()
    {
        $this->middleware('permission:articleList', ['only' => ['index']]);
        $this->middleware('permission:articleCreate', ['only' => ['store']]);
        $this->middleware('permission:articleEdit', ['only' => ['update']]);
        $this->middleware('permission:articleDelete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $articles = Article::get();
       $data = ArticleResource::collection($articles);

       return $this->success($data,"Articles Retrived Successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'required|image',
        ]);

        if($validator->fails()){
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        if($request->hasfile('image')){
            $imagename = time().'.'. $request->image->extension();

            $request->image->move(public_path('articleImages'), $imagename);
        }

        $article = Article::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagename,
        ]);

        return $this->success($article, "Article Created Successfully", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $article = Article::find($id);

       if(!$article){
        return $this->error("Article NOT FOUND", null, 404);
       }

       $data = new ArticleResource($article);

       return $this->success($data, "Article Show Successfully", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        $article = Article::find($id);

        if(!$article){
            return $this->error("Article NOT FOUND", null, 404);
        }
        if($request->hasFile('image')){
            File::delete(public_path('articleImages/' .$article->image));
            $imageName = time(). '.' . $request->image->extension();
            $request->image->move(public_path('articleImages'),$imageName);

           $request->merge(['image' => $imageName]);
        }
        $article->update($request->all());

        return $this->success($article, "Article Updated Successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);

        if(!$article){
            return $this->error("Article NOT FOUND", null, 404);
        }

        $article->delete();

        return $this->success($article, "Article Deleted Successfully", 200);
    }
}
