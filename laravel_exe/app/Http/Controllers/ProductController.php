<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }
    public function store(ProductRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('productImages'), $imageName);

            $data = array_merge($data, ['image' => $imageName]);
        }

        $data['status'] = $request->has('status') ? true : false;
        Product::create($data);
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductEditRequest $request)
    {
        dd($request);
        $updata = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('productImages'), $imageName);

            $data = array_merge($updata, ['image' => $imageName]);
        }
        $updata['status'] = $request->has('status') ? true : false;
        $category = Product::find($request->id);

        $category->update($updata);

        return redirect()->route('products.index');
    }

//    public function update(Request $request)
//    {
//        dd($request);
//        $data = $request->validate(
//            [
//                'name' => 'required|string',
//                'image' => 'nullable|image',
//                'description' => 'required|string',
//                'price' => 'required|integer',
//                'status' => 'nullable',
//            ]
//        );
//        // dd($request);
//        if ($request->hasFile('image')) {
//            $imageName = time() . '.' . $request->image->extension();
//            $request->image->move(public_path('productImages'), $imageName);
//
//            $data = array_merge($data, ['image' => $imageName]);
//        }
//        $data['status'] = $request->has('status') ? true : false;
//        $category = Product::find($request->id);
//        $category->update($data);
//        return redirect()->route('products.index');
//    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
