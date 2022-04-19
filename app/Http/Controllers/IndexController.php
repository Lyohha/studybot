<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index() {
        return view('index.index');
    }

    /**
     * only added for register routes. 
     */
    public function index404() {
        return '';
    }
}
