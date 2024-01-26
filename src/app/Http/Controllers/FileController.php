<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function storeFile(Request $request)
    {
        $file = $request->file('file');
        $file->store('public');
        return $file->hashName();
    }
}
