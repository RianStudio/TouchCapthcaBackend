<?php

namespace App\Http\Controllers;

use App\Passport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class IndexController extends Controller
{

    public function __construct()
    {
        if(Auth::check() == false){
            return redirect()->intended("/auth/login");
        }

    }


    public function index(Request $request){

        $data = $request->session()->all(); var_dump($data);
        $user = \Auth::user(); //获取登录用户的信息 TODO 第一次部署系统,需要创建账户,初始化key
        var_dump($user);
        $func=__FUNCTION__;
        //展示后台首页
        return view('/back/index',[
            'func'=>$func
        ]);
    }


    /**
     * 展示现在的kv
     */
    public function key(Request $request){

        $func=__FUNCTION__;

        //获取当前的密钥
        $user_id=6;
        $info=Passport::getPassport($user_id);

        return view('/back/key',[
            'func'=>$func,
            'info'=>$info,
        ]);
    }

    /**
     * ajax的方式对密钥进行重置
     */
    public function ajaxReset(){



    }
}
