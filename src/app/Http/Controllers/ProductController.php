<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list() {

        $products = Product::limit(150)->get();
        return $products;
    }
}
