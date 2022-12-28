<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list() {

        $products = Product::limit(20)->get();
        // $products = Product::get();
        return $products;
    }

    public function search() {
        $query = request('query');
        $products = Product::where('name', 'like', '%'.$query.'%')->get();
        return $products;
    }

    private function getSKU() {
        return 'TESTSKU';
    }

    public function store(Request $request) {
        if(!$request->id) {
            $product = new Product();
        } else {

            $product = Product::firstOrNew(['id' => $request->id]);
        }


        $product->name = $request->name;
        $product->active = $request->active;
        $product->asin = $request->asin;
        $product->depth = $request->depth;
        $product->ean = $request->ean;
        $product->height = $request->height;
        $product->price = $request->price;
        $product->height = $request->height;
        if(!$request->sku) {
            $product->sku = $this->getSKU();
        }else {

            $product->sku = $request->sku;
        }
        $product->weight = $request->weight;
        $product->width = $request->width;
        $product->save();

        return $product;
    }
}
