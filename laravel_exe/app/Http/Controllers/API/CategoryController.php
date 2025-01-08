<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $data = CategoryResource::collection($categories);

        return $this->success($data, "Category Retrived Successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image',
        ]);

        if($validator->fails()){
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        if($request->hasfile('image')){
            $imagename = time().'.'. $request->image->extension();

            $request->image->move(public_path('categoryImages'), $imagename);
        }

        $category = Category::create([
            'name' => $request->name,
            'image' => $imagename,
        ]);

        return $this->success($category, "Category Created Successfully", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $category = Category::find($id);

       if(!$category){
        return $this->error("Category NOT FOUND", null, 404);
       }

       $data = new CategoryResource($category);

       return $this->success($data, "Category Show Successfully", 200);
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

        $category = Category::find($id);
        if(!$category){
            return $this->error("Category NOT FOUND", null, 404);
        }

        $category->update($request->all());

        return $this->success($category, "Category Updated Successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return $this->error("Category NOT FOUND", null, 404);
        }

        $category->delete();

        return $this->success($category, "Category Deleted Successfully", 200);
    }
}
