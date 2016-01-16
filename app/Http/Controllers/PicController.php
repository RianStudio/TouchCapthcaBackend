<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libs\ImageCrop;
use App\Libs\ImageCom;
use App\Record;
use App\User;
use App\Passport;

class PicController extends Controller
{



    /**
     *
     * 输出图片
     * @param Request $request
     */
    function output(Request $request){
        //对传递过来的key 和密码进行检验
        $un_key=$request->get("k");
        $un_s=$request->get("s");

        //进行检测,检查是不是正确
        //kv生成流程,创建用户,创建kv,一个用户可以对应多个app,每个app有对应的kv
        //*模拟创建用户
//        $user_id=User::addUser("coder".rand(10,99),"233".rand(100,999)."@qq.com","123456");
        //*模拟创建app
//        $kv=Passport::addAppPassport($user_id);
        //对传递过来的数据进行验证
        $find=Passport::checkPassport($un_key,$un_s);
        //错误处理,如果是错误的账户密码,返回什么情况

        if($find === false){
            //返回错误的json
            $fail_json=[
                'type'=>0,

            ];
            header('Access-Control-Allow-Origin:*');
            return response()->json($fail_json);
        }

        //随机生成本地cooike保存的字符串进行匹配
        $cookie_str=md5(substr( md5(microtime()),2,10));
        //模拟接收kv

        $url='http://tback.localhost:8080/';
        //模拟根据返回相关图片

        //随机产生原图路径
        $pathToFile="./asset/pics/".rand(1,8).".jpg";


        //随机产生被裁剪的横坐标和纵坐标
        $rand_x=rand(10,200);
        $rand_y=rand(10,150);


        //根据时间随机生成按钮路径
        $crop_img='./pic/afterCrop'.time().'.jpg';

        $ic=new ImageCrop($pathToFile,$crop_img);
        $ic->Cut(40,30,$rand_x,$rand_y);
        $ic->SaveImage();
        $ic->destory();

        //合成可以提示用户的水印
        $save_path="./pic";
        $noic_file='wa'.time().'.jpg';
        $notice=new ImageCom();
        $water_icon='./asset/pics/water.jpg';
        //背景路径
        $wa= $notice->img_water_mark($pathToFile,$water_icon,$save_path,$noic_file,6,100,$rand_x,$rand_y);


        //一次请求.返回全部的数据
        $result=[
            'type'=>1,
            'r'=>$url.$pathToFile,
            'w'=>$url.$crop_img,
            'a'=>$url.$wa,
            'x'=>$rand_x,
            'y'=>$rand_y,
            'c'=>$cookie_str,
        ];

        //

        //添加记录
        Record::AddRecord("","",$find,$pathToFile,$crop_img,$wa,$rand_x,$rand_y,$cookie_str);

        //能进行跨域调用
        header('Access-Control-Allow-Origin:*');

        return response()->json($result);
    }


    //后端进行校验





}
