<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list() {

        $products = Product::limit(20)->get();
        return $products;
    }

    public function search() {
        $query = request('query');
        $products = Product::where('name', 'like', '%'.$query.'%')->get();
        return $products;
    }
}
