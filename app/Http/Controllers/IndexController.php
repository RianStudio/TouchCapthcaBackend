<?php

namespace App\Http\Controllers;

use App\Passport;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index(){
        $func=__FUNCTION__;
        //展示后台首页
        return view('/back/index',[
            'func'=>$func
        ]);
    }


    /**
     * 展示现在的kv
     */
    public function key(){
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
