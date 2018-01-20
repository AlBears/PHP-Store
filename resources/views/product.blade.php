@extends('layouts.app')
@section('title') {{ $product->name }} @endsection
@section('data-page-id', 'product')

@section('content')
    <div v-cloak class="product" id="product" data-token="{{ $token }}"
         data-id="{{ $product->id }}">
        <div class="text-center">
            <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem;
            padding-bottom: 3rem; color: #0a0a0a;"></i>
        </div>
        <section class="item-container" v-if="loading == false">
            <div class="row column">
                <nav aria-label="You are here:" role="navigation">
                    <ul class="breadcrumbs">
                        <li><a :href="'/product/category/' + category.slug">
                                @{{ category.name }}</a>
                        </li>
                        <li><a :href="'/product/subcategory/' + subCategory.slug">
                                @{{ subCategory.name }}</a>
                        </li>
                        <li>@{{ product.name }}</li>
                    </ul>
                </nav>
            </div>
            
            <div class="row collapse">
                <div class="small-12 medium-5 large-4 column">
                    <div>
                        <img :src="'/' + product.image_path" width="100%" height="200">
                    </div>
                </div>
                <div class="small-12 medium-7 large-8 column">
                    <div class="product-details">
                        <h2> @{{ product.name }}</h2>
                        <p>@{{ product.description }}</p>
                        <h2>$@{{ product.price }}</h2>
                        <button class="button alert">Add to Cart</button>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="home" v-if="loading == false">
            <div class="display-products">
                <div class="row medium-up-2 large-up-4">
                    <h2>Similar Products</h2>
                    <div class="small-12 column" v-cloak v-for="similar in similarProducts">
                        <a :href="'/product/' + similar.id">
                            <div class="card" data-equalizer-watch>
                                <div class="card-section">
                                    <img :src="'/' + similar.image_path" width="100%" height="200">
                                </div>
                                <div class="card-section">
                                    <p>
                                        @{{ stringLimit(similar.name, 15) }}
                                    </p>
                                    <a :href="'/product/' + similar.id" class="button more expanded">
                                        See More
                                    </a>
                                    <a :href="'/product/' + similar.id" class="button cart expanded">
                                        $@{{ similar.price }} - Add to cart
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop