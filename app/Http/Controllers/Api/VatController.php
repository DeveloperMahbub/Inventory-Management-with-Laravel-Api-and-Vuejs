<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;

class VatController extends Controller
{
    public function vats()
    {
        $vat = Extra::first();
        return response()->json($vat);
    }
}
