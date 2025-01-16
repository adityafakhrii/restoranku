<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('item.index', compact('items'));
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        Item::create($request->all());

        return redirect()->route('item.index')->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $item->update($request->all());

        return redirect()->route('item.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('item.index')->with('success', 'Item deleted successfully.');
    }
}
