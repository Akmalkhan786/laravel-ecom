<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $products = Product::orderBy('id', 'desc')->get();
        $products = Product::inRandomOrder()->get();
        $categories = Category::with('categories')->where('parent_id', 0)->get();
        return view('index', compact('products', 'categories'));
    }
}
