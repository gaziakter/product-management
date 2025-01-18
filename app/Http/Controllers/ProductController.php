<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show All Products in index page
    public function list(Request $request)
    {
        $query = ProductModel::query();

        // Sorting
        if ($request->has('sort')) {
            $query->orderBy($request->input('sort'), $request->input('direction', 'asc'));
        }

        // Searching
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('product_id', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->orWhere('price', $search);
        }

        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }

    // Create product
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional, must be an image file

        ]);

            // Create a new 
            $ProductData = new ProductModel();
    
            // Set the category details
            $ProductData->product_id = $request->product_id;
            $ProductData->name = $request->name;
            $ProductData->description = $request->description;
            $ProductData->price = $request->price;
            $ProductData->stock = $request->stock;
            

        // Handle file upload 
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();  // 3434343443.jpg
            $file->move(public_path('assets/products'), $filename);
            $ProductData->image = $filename;
        }

        // Save the new product
        if ($ProductData->save()) {

            return redirect()->route('products.list')->with('success', 'Product Create successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to Create Product');
        }
    }

    //show book list
    public function specific($id){
        $product = ProductModel::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
