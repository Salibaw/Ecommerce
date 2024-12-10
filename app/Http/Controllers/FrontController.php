<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        return view('front.home', compact('categories'));
    }
    public function shop(){
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        return view('front.shop', compact('categories'));
    }
    public function cart(){
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        return view('front.cart', compact('categories'));
    }

}
