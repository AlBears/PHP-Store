@extends('layouts.app')
@section('title', 'Your Shopping Cart')
@section('data-page-id', 'cart')

@section('content')
    <div v-cloak class="shopping_cart" id="shopping_cart" style="padding: 6rem;">

        <div class="text-center">
            <img v-show="loading" src="/images/loading.gif">
        </div>
        
    </div>
@stop