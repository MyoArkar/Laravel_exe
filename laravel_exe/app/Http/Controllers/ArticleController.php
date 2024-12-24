<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\File;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ArticleController extends Controller
{   
    protected $articleRepository;
    protected $categoryRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository,CategoryRepositoryInterface $categoryRepository)
    {   $this->middleware('auth');
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {

        $articles = $this->articleRepository->index();
        return view('articles.index', compact('articles'));
    }
    public function create()
    {   
        $categories = $this->categoryRepository->index();
        return view('articles.create', compact('categories'));
    }
    public function store(ArticleRequest $request)
    {   
        $data = $request->validated();
        
        if($request->hasFile('image')){
            $imageName = time(). '.' . $request->image->extension();
            $request->image->move(public_path('articleImages'),$imageName);

            $data = array_merge($data,['image' => $imageName]);
        }
        $data['status'] = $request->has('status') ? true :false;

        $this->articleRepository->store($data);

        return redirect()->route('articles.index');
    }
    public function edit($id)
    {   
        $categories = $this->categoryRepository->index();
        $article = $this->articleRepository->show($id);

        return view('articles.edit', compact('article','categories'));
    }
    public function update(ArticleRequest $request)
    {
        $data = $request->validated();
        if($request->old_image && !($request->hasFile('image'))){
            $data = array_merge($data,['image' => $request->old_image]);
        }else{
            if($request->hasFile('image')){
                File::delete(public_path('articleImages/' .$request->old_image));
                $imageName = time(). '.' . $request->image->extension();
                $request->image->move(public_path('articleImages'),$imageName);

                $data = array_merge($data,['image' => $imageName]);
            }
        }
        $data['status'] = $request->has('status') ? true :false;

        $article = $this->articleRepository->show($request->id);
        $article->update($data);

        return redirect()->route('articles.index');

    }
    public function delete($id)
    {
        $article = $this->articleRepository->show($id);

        $article->delete();

        return redirect()->route('articles.index');
    }
}
