<?php

namespace App\Http\Controllers;

use App\Models\WarehousePlace as WarehousePlace;
use Illuminate\Http\Request;

class WarehousePlaceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'warehouse.id' => 'required|numeric',
        ]);

        if($request->input('id')) {
            $warehousePlace = WarehousePlace::with('warehouse')->find($request->input('id'));
        } else {

            $warehousePlace = new WarehousePlace();
        }

        // Create a new warehouse place
        $warehousePlace->name = $request->input('name');
        $warehousePlace->warehouse_id = $request->input('warehouse.id');
        $warehousePlace->save();

        // Return the newly created warehouse place
        // return response()->json([
        //     'message' => 'Warehouse place created successfully',
        //     'warehouse_place' => WarehousePlace::with('warehouse')->find($warehousePlace->id),
        // ], 201);
        return response()->json( WarehousePlace::with('warehouse')->find($warehousePlace->id), 200);
    }

    public function list()
{
    // Get all warehouse places
    $warehousePlaces = WarehousePlace::with('warehouse')->get();

    // Return the warehouse places
    return response()->json($warehousePlaces);
}

public function delete(Request $request, $id) {
    $warehousePlace = WarehousePlace::find($id);

    if (!$warehousePlace) {
        return response()->json(['error' => 'Warehouse not found'], 404);
    }

    $warehousePlace->delete();

    return response()->json(['message' => 'WarehousePlace deleted successfully'], 200);
}
}
