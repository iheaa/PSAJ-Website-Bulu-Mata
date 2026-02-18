<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function dashboard()
    {
        $totalCatalogs = \App\Models\Catalog::count();

        $paidOrders = \App\Models\Order::where(function ($q) {
            $q->where('status', 'paid')
                ->orWhere('status', 'processing')
                ->orWhere('status', 'shipped')
                ->orWhere('status', 'completed');
        });

        // Total Items Sold (sum of quantities in order_items for paid orders)
        // We need to join with order_items
        $totalItemsSold = \App\Models\OrderItem::whereHas('order', function ($q) {
            $q->where('status', 'paid')
                ->orWhere('status', 'processing')
                ->orWhere('status', 'shipped')
                ->orWhere('status', 'completed');
        })->sum('quantity');

        // Monthly Revenue (Current Month)
        // We need to clone the query builder or create a new one because the previous one might be modified
        $monthlyRevenue = \App\Models\Order::where(function ($q) {
            $q->where('status', 'paid')
                ->orWhere('status', 'processing')
                ->orWhere('status', 'shipped')
                ->orWhere('status', 'completed');
        })
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        return view('admin.dashboard', compact('totalCatalogs', 'totalItemsSold', 'monthlyRevenue'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogs = \App\Models\Catalog::all();
        return view('admin.catalogs.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.catalogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        // Remove dots from price (IDR format support: 35.000 -> 35000)
        if ($request->has('price')) {
            $request->merge([
                'price' => str_replace(['.', ','], '', $request->price)
            ]);
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        }

        \App\Models\Catalog::create([
            'image' => $imagePath,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.catalogs.index')->with('success', 'Catalog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Catalog $catalog)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Catalog $catalog)
    {
        return view('admin.catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Catalog $catalog)
    {
        // Remove dots from price (IDR format support)
        if ($request->has('price')) {
            $request->merge([
                'price' => str_replace(['.', ','], '', $request->price)
            ]);
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($catalog->image && file_exists(public_path($catalog->image))) {
                unlink(public_path($catalog->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $data['image'] = 'uploads/products/' . $imageName;
        }

        $catalog->update($data);

        return redirect()->route('admin.catalogs.index')->with('success', 'Catalog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Catalog $catalog)
    {
        if ($catalog->image && file_exists(public_path($catalog->image))) {
            unlink(public_path($catalog->image));
        }

        $catalog->delete();

        return redirect()->route('admin.catalogs.index')->with('success', 'Catalog deleted successfully.');
    }
}