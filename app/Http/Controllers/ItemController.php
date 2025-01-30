<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Category;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('name', 'asc')->get();
        return view('admin.item.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.item.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'img' => 'required|image|mimes:jpg,png|max:2048',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Name field is required.',
            'description.required' => 'Description field is required.',
            'price.required' => 'Price field is required.',
            'category_id.required' => 'Category field is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'img.required' => 'Image field is required.',
            'img.image' => 'Image field must be an image.',
            'img.mimes' => 'Image must be a file of type: jpg, png.',
            'img.max' => 'Image size must not exceed 2MB.',
            'is_active.required' => 'Active status field is required.',
        ]);

        // Handle file upload
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload'), $imageName);
            $validatedData['img'] = $imageName;
        }

        $item = Item::create($validatedData);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('admin.item.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'img' => 'sometimes|image|mimes:jpg,png|max:2048',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Name field is required.',
            'description.required' => 'Description field is required.',
            'price.required' => 'Price field is required.',
            'category_id.required' => 'Category field is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'img.image' => 'Image field must be an image.',
            'img.mimes' => 'Image must be a file of type: jpg, png.',
            'img.max' => 'Image size must not exceed 2MB.',
            'is_active.required' => 'Active status field is required.',
        ]);

        // Handle file upload
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload'), $imageName);
            $validatedData['img'] = $imageName;
        }

        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->is_active = false;
        $item->save();

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
