<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function show($id)
    {
        $product = Catalog::findOrFail($id);
        return view('product_detail', compact('product'));
    }
}