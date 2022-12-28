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
            'warehouse_id' => 'required|numeric',
        ]);

        // Create a new warehouse place
        $warehousePlace = new WarehousePlace();
        $warehousePlace->name = $request->input('name');
        $warehousePlace->warehouse_id = $request->input('warehouse_id');
        $warehousePlace->save();

        // Return the newly created warehouse place
        return response()->json([
            'message' => 'Warehouse place created successfully',
            'warehouse_place' => WarehousePlace::with('warehouse')->find($warehousePlace->id),
        ], 201);
    }

    public function list()
{
    // Get all warehouse places
    $warehousePlaces = WarehousePlace::with('warehouse')->get();

    // Return the warehouse places
    return response()->json($warehousePlaces);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WarehousePlace  $warehousePlace
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehousePlace $warehousePlace)
    {
        //
    }
}
