<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicCatalogController extends Controller
{
    public function index()
    {
        $catalogs = \App\Models\Catalog::all();
        return view('catalog', compact('catalogs'));
    }
}