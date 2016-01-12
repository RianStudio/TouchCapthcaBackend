<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index(){
        //展示后台首页
        return view('/back/index');
    }
}
