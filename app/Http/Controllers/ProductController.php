<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::with('category')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Product/Create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024'
        ]);

        if ($data['image']) {
            $data['image'] = FacadesRequest::file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect('/products')->with('message', 'Product created!');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $image = asset('storage/' . $product->image);

        return Inertia::render('Product/Show', compact('product', 'image'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $image = asset('storage/' . $product->image);

        return Inertia::render('Product/Edit', compact('product', 'categories', 'image'));
    }

    public function update(Request $request, $id)
    {
        if (is_string($request->image)) {
            $rule = 'nullable|string';
        } else {
            $rule = 'nullable|image|mimes:jpg,png,jpeg,webp|max:1024';
        }

        $data = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'image' => $rule
        ]);

        $data['image'] = $request->image;

        if (FacadesRequest::file('image')) {
            Storage::delete('public/category/' . $request->image);
            $data['image'] = FacadesRequest::file('image')->store('products', 'public');
        }

        Product::findOrFail($id)->update($data);

        return redirect('/products')->with('message', 'Product updated!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        }

        return redirect()->back()
                ->with('message', 'Product delete');
    }
}
