@extends('admin.layout.base')
@section('title', 'Edit Product')
@section('data-page-id', 'adminProduct')

@section('content')
<div class="add-product">
    <div class="row expanded">
        <div class="column medium-11">
            <h2>Edit {{ $product->name }}</h2> <hr />
        </div>
    </div>
    
    @include('includes.message')
    
    <form method="post" action="/admin/product/edit" enctype="multipart/form-data">
        <div class="small-12 medium-11">
            <div class="row expanded">
                <div class="small-12 medium-6 column">
                <label>Product name:
                    <input type="text" name="name" value="{{ $product->name }}">
                </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <label>Product price:
                        <input type="text" name="price" value="{{ $product->price }}">
                    </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <label>Product Category:
                        <select name="category" id="product-category">
                            <option value="{{ $product->category->id }}">
                                {{ $product->category->name }}
                            </option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <label>Product Subcategory:
                        <select name="subcategory" id="product-subcategory">
                            <option value="{{ $product->subCategory->id }}">
                                {{ $product->subCategory->name }}
                            </option>
                        </select>
                    </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <label>Product Quantity:
                        <select name="quantity">
                            <option value="{{ $product->quantity }}">
                                {{ $product->quantity }}
                            </option>
                            @for($i = 1; $i <= 50; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <br />
                   <div class="input-group">
                       <span class="input-group-label">Product Image:</span>
                       <input type="file" name="productImage" class="input-group-field">
                   </div>
                </div>
                
                <div class="small-12 column">
                    <label>Description:
                    <textarea name="description" placeholder="Description">{{$product->description}}</textarea>
                    </label>
                    <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input class="button warning float-right" type="submit" value="Update Product">
                </div>
            </div>
        </div>
    </form>
</div>
@include('includes.delete-modal')
@endsection