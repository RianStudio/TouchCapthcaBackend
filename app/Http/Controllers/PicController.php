<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libs\ImageCrop;
use App\Libs\ImageCom;
use App\Record;

class PicController extends Controller
{



    /**
     *
     * 输出图片
     * @param Request $request
     */
    function output(Request $request){


        //需要定时删除对应的文件
        //每10s进行一次刷新

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
        //$ic->SaveAlpha();将补白变成透明像素保存
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
            'r'=>$url.$pathToFile,
            'w'=>$url.$crop_img,
            'a'=>$url.$wa,
            'x'=>$rand_x,
            'y'=>$rand_y,
            'c'=>$cookie_str,

        ];

        //

        //添加记录
        Record::AddRecord("","","",$pathToFile,$crop_img,$wa,$rand_x,$rand_y,$cookie_str);

        //能进行跨域调用
        header('Access-Control-Allow-Origin:*');

        return response()->json($result);
    }



}
