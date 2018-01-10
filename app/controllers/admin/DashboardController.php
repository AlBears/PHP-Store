<?php
namespace App\Controllers\Admin;

use App\Classes\Session;
use App\Controllers\BaseController;
use App\Classes\Request;

class DashboardController extends BaseController
{
    
    public function show()
    {
        Session::add('admin', 'You are welcome!');
        Session::remove('admin');

        if(Session::has('admin')){
            $msg = Session::get('admin');
        } else {
            $msg = 'Not defined';
        }
        return view('admin/dashboard', ['admin' => $msg]);
    }

    public function get()
    {
        Request::refresh();
        $data = Request::old('post', 'product');
        var_dump($data);
        exit;

    }
}