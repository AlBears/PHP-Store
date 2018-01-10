<?php

namespace App\Controllers\Admin;
use App\Models\Category;
use App\Classes\Request;
use App\Classes\CSRFToken;

class ProductCategoryController
{
    public function show()
    {
        $categories = Category::all();
        
        return view('admin/products/categories', compact('categories'));
    }

    public function store()
    {
        if(Request::has('post')) {
            $request = Request::get('post');
            
            if(CSRFToken::verifyCSRFToken($request->token)){
                Category::create([
                    'name' => $request->name,
                    'slug' => slug($request->name)
                ]);

                $categories = Category::all();
                $message = 'Category Created';

                return view('admin/products/categories', compact('categories', 'message'));
                
            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }
}