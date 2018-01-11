<?php

namespace App\Controllers\Admin;
use App\Models\Category;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductCategoryController
{
    public $table_name = 'categories';
    public $categories;
    public $links;

    public function __construct()
    {
        $total = Category::all()->count();
        $object = new Category;
    
        list($this->categories, $this->links) = paginate(3, $total, $this->table_name, $object);
    }

    public function show()
    {
        return view('admin/products/categories', [
            'categories' => $this->categories, 'links' => $this->links
        ]);
    }

    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            
            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                  'name' => ['required' => true, 'minLength' => 3, 'string' => true, 'unique' => 'categories']
                ];
                
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError()){
                    $errors = $validate->getErrorMessages();
                    return view('admin/products/categories', [
                        'categories' => $this->categories, 'links' => $this->links, 'errors' => $errors
                    ]);
                }
                //process form data
                Category::create([
                    'name' => $request->name,
                    'slug' => slug($request->name)
                ]);
                
                $total = Category::all()->count();
                list($this->categories, $this->links) = paginate(3, $total, $this->table_name, new Category);
                return view('admin/products/categories', [
                    'categories' => $this->categories, 'links' => $this->links, 'success' => 'Category Created'
                ]);
            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }
}