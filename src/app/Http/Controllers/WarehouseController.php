<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function store(Request $request) {
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'address' => 'required',
            'address.name1' => 'required',
            // 'email' => 'required|email',
            // 'password' => 'required',
            // 'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        // var_dump($data);
        // die();
        if(!isset( $data['id'])) {
            $warehouse = new Warehouse();
        } else {
            $warehouse = Warehouse::find($data['id']);
        }
        if(!isset($data['address']['id'])) {
            $address = new Address();
        } else {
            $address = Address::find($data['address']['id']);
        }
        $address->name1 = $data['address']['name1'];
        $address->name2 = $data['address']['name2'];
        $address->name3 = $data['address']['name3'];
        $address->city = $data['address']['city'];
        $address->street = $data['address']['street'];
        $address->housenumber = $data['address']['housenumber'];
        $address->zip = $data['address']['zip'];
        $address->country = $data['address']['country'];
        $address->save();
        $warehouse->name = $data['name'];
        $warehouse->addresses_id = $address->id;
        $warehouse->save();

        
        
        return $this->getwarehouse($warehouse->id);
    }

    public function getwarehouse($id) {
            // echo $id;
        return Warehouse::find($id);
    }
    public function getwarehouses() {
            // echo $id;
        return Warehouse::all();
    }

    public function delete(Request $request, $id) {
        $warehouse = Warehouse::find($id);
    
        if (!$warehouse) {
            return response()->json(['error' => 'Warehouse not found'], 404);
        }
    
        $address = Address::find($warehouse->addresses_id);
        $warehouse->delete();
        $address->delete();
    
        return response()->json(['message' => 'Warehouse and associated address deleted successfully'], 200);
    }
    
}
