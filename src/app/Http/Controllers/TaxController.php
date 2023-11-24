<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function getTaxRates(Request $request)
    {
        $taxes = Tax::orderBy('rate')->get();
        return $taxes;
    }
}
