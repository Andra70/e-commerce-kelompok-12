<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->when($request->category, function ($query, $categorySlug) {
                return $query->whereHas('productCategory', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->latest()
            ->paginate(12);
            
        $categories = ProductCategory::all();
        return view('home.index', compact('products', 'categories'));
    }

    public function product(Product $product)
    {
        return view('home.product', compact('product'));
    }

    public function checkout(Product $product)
    {
        return view('transaction.checkout', compact('product'));
    }

    public function history()
    {
        // Assuming relationship buyer -> user exists or we check by user_id if we fetch buyer first
        $user = auth()->user();
        // Check if user is a buyer, if not maybe empty
        $buyer = $user->buyer; 
        
        $transactions = collect();
        if ($buyer) {
            $transactions = \App\Models\Transaction::where('buyer_id', $buyer->id)->latest()->get();
        }
        
        return view('transaction.history', compact('transactions'));
    }
}
