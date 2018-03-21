<?php

namespace App\Controllers;

use App\Models\Product;
use App\Classes\Request;
use App\Classes\CSRFToken;


class AuthController extends BaseController
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function register()
    {

    }

    public function login()
    {
        
    }

}