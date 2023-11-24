<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'quantity' => 'required',
            'warehouse_places_id' => 'required',
            'products_id' => 'required',
            // 'email' => 'required|email',
            // 'password' => 'required',
            // 'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $inventory = new Inventory();
        $inventory->quantity = $data['quantity'];
        $inventory->change_date = new DateTime();
        $inventory->warehouse_places_id = $data['warehouse_places_id'];
        $inventory->products_id = $data['products_id'];

        $inventory->save();
        return $inventory;
    }

    function createQuery()
    {
        $productsQuery = DB::table('products')->orderBy('products.name');
        $productsQuery->selectRaw('sum(quantity) as quantity, products.name as products_name, warehouse_places.name as warehouse_places_name, products.id as products_id, warehouse_places.id as warehouse_places_id');
        $productsQuery->groupBy('products.id');
        $productsQuery->groupBy('warehouse_places.id');
        $productsQuery->join('inventories', 'products.id', '=', 'products_id');
        $productsQuery->join('warehouse_places', 'warehouse_places.id', '=', 'warehouse_places_id');
        return $productsQuery;
    }

    public function productsByWarehousePlace($id)
    {
        $productsQuery = $this->createQuery();
        $productsQuery->where('warehouse_places_id', '=', $id);
        $products = $productsQuery->get();
        if (count($products) > 0) {

            return $products;
        }

        return response()->json(['error' => 'Products not found'], 404);
    }
    public function productsByProductId($id)
    {
        $productsQuery = $this->createQuery();
        $productsQuery->where('products_id', '=', $id);
        $products = $productsQuery->get();
        if (count($products) > 0) {

            return $products;
        }

        return response()->json(['error' => 'Products not found'], 404);
    }
}
