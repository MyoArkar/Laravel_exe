<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request)
    {
        $product = Product::find($request->id);

        $product->update(
            [
                'name' => $request->name,
                'description' => $request->desc,
                'price' => $request->price,
            ]
        );

        return redirect()->route('products.index');
    }

    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        
        $data = $request->validate(
            [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer'
            ]
        );
        Product::create($data);
        return redirect()->route('products.index');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
