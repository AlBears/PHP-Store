<?php

namespace App\Classes;

class Redirect
{
    /**
     * Redirect to specific page
     * @param $page
     */

    public static function to($page)
    {
        header("location: $page");
    }

    
    /**
     * Redirect to the same page
     */

    public static function back()
    {
        $uri = $_SERVER['REQUEST_URI'];
        header("location:$uri");
    }
}