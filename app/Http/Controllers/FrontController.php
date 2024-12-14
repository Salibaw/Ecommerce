<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        $products = Product::with('images')->where('status', 1)->get();
        return view('front.home', compact('categories', 'products')); 
    }
    public function shop(){
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        $products = Product::with('images')->where('status', 1)->get();
        return view('front.shop', compact('categories','products'));
    }
    public function cart(){
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        $products = Product::with('images')->where('status', 1)->get();
        return view('front.cart', compact('categories','products'));
    }

    
}
