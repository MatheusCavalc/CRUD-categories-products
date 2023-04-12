<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Category/Index', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Category/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024'
        ]);

        if ($data['image']) {
            $data['image'] = FacadesRequest::file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect('categories')->with('message', 'Category created!');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        $image = asset('storage/' . $category->image);

        return Inertia::render('Category/Show', compact('category', 'image'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $image = asset('storage/' . $category->image);

        return Inertia::render('Category/Edit', compact('category', 'image'));
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
            'image' => $rule
        ]);

        $data['image'] = $request->image;

        if (FacadesRequest::file('image')) {
            Storage::delete('public/category/' . $request->image);
            $data['image'] = FacadesRequest::file('image')->store('categories', 'public');
        }

        Category::findOrFail($id)->update($data);

        return redirect('/categories')->with('message', 'Category updated!');
    }

    public function destroy($id)
    {
        $export = Category::find($id);

        if ($export) {
            $export->delete();
        }

        return redirect()->back()
                ->with('message', 'Category delete');
    }
}
