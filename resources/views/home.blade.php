@extends('layouts.app')
@section('title', 'Homepage')
@section('data-page-id', 'home')

@section('content')
    <div class="home">
        
        <section class="hero">
            <div class="hero-slider">
                <div> <img src="/images/sliders/slide_1.jpg" alt="Acme Store"> </div>
                <div> <img src="/images/sliders/slide_2.jpg" alt="Acme Store"> </div>
                <div> <img src="/images/sliders/slide_3.jpg" alt="Acme Store"> </div>
            </div>
        </section>
    
        <section class="display-products" data-token="{{ $token }}" id="root">
            <div class="row medium-up-2 large-up-4">
                <h2>Featured Products</h2>
                <div class="small-12 column" v-cloak v-for="feature in featured">
                    <a :href="'/product/' + feature.id">
                        <div class="card" data-equalizer-watch>
                            <div class="card-section">
                                <img :src="'/' + feature.image_path" width="100%" height="200">
                            </div>
                            <div class="card-section">
                                <p>
                                    @{{ stringLimit(feature.name, 18) }}
                                </p>
                                <a :href="'/product/' + feature.id" class="button more expanded">
                                    See More
                                </a>
                                <button @click.prevent="addToCart(feature.id)" class="button cart expanded">
                                    $@{{ feature.price }} - Add to cart
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    
            <div class="row medium-up-2 large-up-4">
                <h2>Product Picks</h2>
                <div class="small-12 column" v-cloak v-for="product in products">
                    <a :href="'/product/' + product.id">
                        <div class="card" data-equalizer-watch>
                            <div class="card-section">
                                <img :src="'/' + product.image_path" width="100%" height="200">
                            </div>
                            <div class="card-section">
                                <p>
                                    @{{ stringLimit(product.name, 18) }}
                                </p>
                                <a :href="'/product/' + product.id" class="button more expanded">
                                    See More
                                </a>
                                <button @click.prevent="addToCart(product.id)" class="button cart expanded">
                                    $@{{ product.price }} - Add to cart
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="text-center">
                <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; paddibg-bottom: 3rem; 
                position:fixed; top: 60%; bottom: 20%; color: #0a2b1d"></i>
            </div>
        </section>
    </div>
@stop