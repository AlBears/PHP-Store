<?php

namespace App\Controllers;

use App\Classes\Cart;
use App\Models\Product;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\CSRFToken;

class CartController extends BaseController
{
    public function show()
    {
        return view('cart');
    }

    public function addItem()
    {
        if (Request::has('post')) {
            $request = Request::get('post');
            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                if (!$request->product_id) {
                    throw new \Exception('Malicious Activity');
                }
                Cart::add($request);
                echo json_encode(['success' => 'Product Added to Cart Successfully']);
                exit;
            }
        }
    }

    public function getCartItems()
    {
        try {
            $result = array();
            $cartTotal = 0;
            if (!Session::has('user_cart') || count(Session::get('user_cart')) < 1) {
                echo json_encode(['fail' => "No item in the cart"]);
                exit;
            }
            $index = 0;
            foreach ($_SESSION['user_cart'] as $cart_items) {
                $productId = $cart_items['product_id'];
                $quantity = $cart_items['quantity'];
                $item = Product::where('id', $productId)->first();

                if (!$item) {
                    continue;
                }

                $totalPrice = $item->price * $quantity;
                $cartTotal = $totalPrice + $cartTotal;
                $totalPrice = number_format($totalPrice, 2);

                array_push($result, [
                'id' => $item->id,
                'name' => $item->name,
                'image' => $item->image_path,
                'description' => $item->description,
                'price' => $item->price,
                'total' => $totalPrice,
                'quantity' => $quantity,
                'stock' => $item->quantity,
                'index' => $index
            ]);
                $index++;
            }

            $cartTotal = number_format($cartTotal, 2);
            echo json_encode(['items' => $result, 'cartTotal' => $cartTotal]);
            exit;

        } catch (\Exception $ex) {
            //log this to DB or email admin
        }
    }
}
