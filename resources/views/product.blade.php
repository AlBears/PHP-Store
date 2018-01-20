@extends('layouts.app')
@section('title') {{ $product->name }} @endsection
@section('data-page-id', 'product')

@section('content')
   <div class="product" style="padding: 6rem;" id="product" 
        data-token="{{ token }}" data-id="{{ $product->id }}">
    <div class="text-center">
        <i class="fa fa-spinner" style="font-size: 3rem;
            padding-bottom: 3rem; color: #0a0a0a;">
        </i>
    </div>       
    <section class="item-container">
        <div class="row column">
            <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                <li><a href="#">Product Category</a></li>
                <li><a href="#">Product Subcategory</a></li>
                <li>Product Name</li>
                </ul>
            </nav>
        </div>
    </section>
   </div>
@stop