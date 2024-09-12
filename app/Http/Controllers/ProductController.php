<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Paginate products, showing 10 per page
        $products = Product::paginate(10);

        return response()->json($products);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect('/products')->with('success', 'Product added successfully!');
    }
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::where('price', '>', $amount)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $this->authorize('update', $product);

        $product->update($request->all());
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    
    public function destroy(Product $product)
    {

        $this->authorize('delete', $product);
    

        $product->delete();
    
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    
}
