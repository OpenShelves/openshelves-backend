<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list() {

        // $products = Product::limit(20)->get();
        $products = Product::get();
        if(count($products)>0) {
            
            return $products;
        } 

        return response()->json(['error'=>'Products not found'], 404);
    }

    public function search() {
        $query = request('query');
        $products = Product::where('name', 'like', '%'.$query.'%')->get();
        if(count($products)>0) {
            
            return $products;
        } 

        return response()->json(['error'=>'Products not found'], 404);
    }

    private function getSKU() {
        return 'TESTSKU';
    }

    public function productbycode(Request $request) {
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $product = Product::where('ean', '=', $data['code'])->first();
        if($product) {

            return $product;
        } 
        return response()->json(['error'=>'Product not found'], 404);            
    }

    public function productbyid($id) {
       
        $product = Product::find($id);
        if($product) {

            return $product;
        } 
        return response()->json(['error'=>'Product not found'], 404);            
    }

    public function totalProducts() {
        $total = array();
        $total['products'] = 0;
        $total['quantity'] = 0;
        $products = Product::all();
        if($products) {
            $total['products'] = count($products);
        }

        $inventory = Inventory::select(DB::raw('sum(quantity) as total'))->first();
        if($inventory  ){
            $total['quantity'] =  intval($inventory['total']);
        }

        return $total;
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
