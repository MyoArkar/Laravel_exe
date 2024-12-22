<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryEditRequest;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{   
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->index();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {   
        $data = $request->validated();
        // Category::create([
        //     'name' => $request->name,
        // ]);
        if($request->hasFile('image')){
            $imageName = time(). '.' . $request->image->extension();
            $request->image->move(public_path('categoryImages'),$imageName);

            $data = array_merge($data,['image' => $imageName]);
        }
        $data['status'] = $request->has('status') ? true : false;
        $this->categoryRepository->store($data);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->show($id);

        return view('categories.edit', compact('category'));
    }

    public function update(CategoryEditRequest $request)
    {   
        
        
        $data = $request->validated();
        if($request->old_image && !($request->hasFile('image'))){
            $data = array_merge($data,['image' => $request->old_image]);
        }else{
            if($request->hasFile('image')){
                File::delete(public_path('categoryImages/' .$request->old_image));
                $imageName = time(). '.' . $request->image->extension();
                $request->image->move(public_path('categoryImages'),$imageName);
    
                $data = array_merge($data,['image' => $imageName]);
            }
        }
        
        $data['status'] = $request->has('status') ? true : false;
        $category = $this->categoryRepository->show($request->id);

        $category->update($data);

        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->show($id);

        $category->delete();

        return redirect()->route('categories.index');
    }
}
