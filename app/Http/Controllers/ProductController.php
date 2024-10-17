<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request, Product $product) {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // $product = new Product($request->except('image'));
        $product->name = $request->input('name');
        $product->amount = $request->input('amount');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $name =  basename($path);
            $product->image = $name; 
        }
        $product->save();

        return response()->json([
            'message' => 'Product created successfully.',
            'redirect' => route('products.index'),
        ]);
        // return response()->json(['message' => 'Product created successfully.']);
    }
    
    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->name = $request->input('name');
        $product->amount = $request->input('amount');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            Storage::delete('public/' . str_replace('/storage/', '', $product->image));

            $path = $request->file('image')->store('images', 'public');
            // $product->image = Storage::url($path);
            $name =  basename($path);
            $product->image = $name; 
        }
    
        $product->save();

        return response()->json([
            'message' => 'Product updated successfully.',
            'redirect' => route('products.index'),
        ]);
        // return response()->json(['message' => 'Product updated successfully.']);
    }
    
    
    public function show(Product $product) {
        return view('products.show', compact('product'));
    }

    public function destroy(Product $product) {
        Storage::delete('public/' . $product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
