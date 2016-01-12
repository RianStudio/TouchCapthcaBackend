<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    //用户登录
    public static function index(Request $request){

        if($request->method() == "POST"){

            //先跳转到后台首页去
            return redirect('/backend/index');
        }
        return view('others/login');
    }

}
