<?php

namespace App\Controllers;

use App\Models\Product;
use App\Classes\Request;
use App\Classes\CSRFToken;


class ProductController extends BaseController
{
    public function show($id)
    {
        $token = CSRFToken::_token();
        $product = Product::where('id', $id)->first();
        return view('product', compact('token', 'product'));
    }
}