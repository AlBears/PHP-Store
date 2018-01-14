<?php
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\UploadFile;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends BaseController
{
    public $table_name = 'products';
    public $products;
    public $categories;
    public $subcategories;
    public $subcategories_links;
    public $links;
    
    public function __construct()
    {
        $this->categories = Category::all();
        $total = Product::all()->count();
        list($this->products, $this->links) = paginate(10, $total, $this->table_name, new Product);
    }
    
    public function show()
    {
        $products = $this->products;
        $links = $this->links;
        return view('admin/products/inventory', compact('products', 'links'));
    }
    
    public function showEditProductForm($id)
    {
        $categories = $this->categories;
        $product = Product::where('id', $id)->with(['category', 'subCategory'])->first();
        return view('admin/products/edit', compact('product', 'categories'));
    }
    
    public function showCreateProductForm()
    {
        $categories = $this->categories;
        return view('admin/products/create', compact('categories'));
    }
    
    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            $file_error = [];
            
            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                  'name' => ['required' => true, 'minLength' => 3,'maxLength' => 70, 'mixed' => true, 'unique' => $this->table_name],
                  'price' => ['required' => true, 'minLength' => 2, 'number' => true],
                  'quantity' => ['required' => true],
                  'category' => ['required' => true], 'subcategory' => ['required' => true],
                  'description' => ['required' => true, 'mixed' => true, 'minLength' => 4,'maxLength' => 500,]
                ];
                
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                $file = Request::get('file');
                isset($file->productImage->name)? $filename = $file->productImage->name : $filename = '';
                
                if(empty($filename)){
                    $file_error['productImage'] = ['The product image is required'];
                }else if(!UploadFile::isImage($filename)){
                    $file_error['productImage'] = ['The image is invalid, please try again.'];
                }
                
                if($validate->hasError()){
                    $response = $validate->getErrorMessages();
                    count($file_error) ? $errors = array_merge($response, $file_error) : $errors = $response;
                    return view('admin/products/create', [
                        'categories' => $this->categories, 'errors' => $errors
                    ]);
                }
                
                $ds = DIRECTORY_SEPARATOR;
                $temp_file = $file->productImage->tmp_name;
                $image_path = UploadFile::move($temp_file, "images{$ds}uploads{$ds}products", $filename)->path();
                
                //process form data
                Product::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category_id' => $request->category,
                    'sub_category_id' => $request->subcategory,
                    'image_path' => $image_path,
                    'quantity' => $request->quantity,
                ]);
                
                Request::refresh();
                return view('admin/products/create', [
                    'categories' => $this->categories, 'success' => 'Record Created'
                ]);
            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }
    
    public function edit()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            $file_error = [];
        
            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                    'name' => ['required' => true, 'minLength' => 3,'maxLength' => 70, 'mixed' => true],
                    'price' => ['required' => true, 'minLength' => 2, 'number' => true],
                    'quantity' => ['required' => true],
                    'category' => ['required' => true], 'subcategory' => ['required' => true],
                    'description' => ['required' => true, 'mixed' => true, 'minLength' => 4,'maxLength' => 500,]
                ];
            
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
            
                $file = Request::get('file');
                isset($file->productImage->name)? $filename = $file->productImage->name : $filename = '';
            
                if(isset($file->productImage->name) && !UploadFile::isImage($filename)){
                    $file_error['productImage'] = ['The image is invalid, please try again.'];
                }
            
                if($validate->hasError()){
                    $response = $validate->getErrorMessages();
                    count($file_error) ? $errors = array_merge($response, $file_error) : $errors = $response;
                    return view('admin/products/create', [
                        'categories' => $this->categories, 'errors' => $errors
                    ]);
                }
                
                $product = Product::findOrFail($request->product_id);
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->sub_category_id = $request->subcategory;
            
                if($filename){
                    $ds = DIRECTORY_SEPARATOR;
                    $old_image_path = BASE_PATH."{$ds}public{$ds}$product->image_path";
                    $temp_file = $file->productImage->tmp_name;
                    $image_path = UploadFile::move($temp_file, "images{$ds}uploads{$ds}products", $filename)->path();
                    unlink($old_image_path);
                    $product->image_path = $image_path;
                }
                $product->save();
                Session::add('success', 'Record Updated');
                Redirect::to('/admin/products');
            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }
    
    public function delete($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            
            if(CSRFToken::verifyCSRFToken($request->token)){
                Product::destroy($id);
                Session::add('success', 'Product Deleted');
                Redirect::to('/admin/products');
            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }
    
    public function getSubcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        echo json_encode($subcategories);
        exit;
    }
}