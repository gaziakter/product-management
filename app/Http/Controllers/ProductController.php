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
}
