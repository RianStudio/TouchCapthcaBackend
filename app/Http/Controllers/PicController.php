<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libs\ImageCrop;
use App\Libs\ImageCom;

class PicController extends Controller
{



    /**
     *
     * 输出图片
     * @param Request $request
     */
    function output(Request $request){
        //模拟接收kv


        $url='http://tback.localhost:8080/';
        //模拟根据返回相关图片

        $s= $request->get('s');

        //根据参数状态返回对于的图片
        $pathToFile="./pic/a.jpg";


      //随机产生位置
        $rand_x=rand(10,200);
        $rand_y=rand(10,150);


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
        $water_icon='./water.jpg';
       $w_path= $notice->img_water_mark($pathToFile,$water_icon,$save_path,$noic_file,6,100,$rand_x,$rand_y);


        //一次请求.返回全部的数据

        $result=[
            'r'=>$url.$pathToFile,
            'w'=>$url.$crop_img,
            'a'=>$url.$w_path,
            'x'=>$rand_x,
            'y'=>$rand_y,
        ];

        header('Access-Control-Allow-Origin:*');

        return response()->json($result);
//        if($s == 1){
//
//            //模拟输出完整图片
//            return response()->download($pathToFile);
//
//        }
//
//        if($s == 2){
//
//            return response()->download($crop_img);
//
//            //模拟输出裁剪之后的图片
//        }
//        if($s == 3){
//
//            return response()->download($w_path);
//        }
//
//        if($s == 4){
//
//            //允许跨域调用
//            header('Access-Control-Allow-Origin:*');
//
//
//
//            //返回产生的坐标
//
//            return response()->json(['x'=>$rand_x,'y'=>$rand_y]);
//        }
    }


    /**
     * 返回当前用户的当前请求的图片校验坐标
     * @param Request $request
     */
    public function xy(Request $request){

        //允许跨域调用
        header('Access-Control-Allow-Origin:*');
        $x=120;
        $y=130;


        //返回产生的坐标

        return response()->json(['x'=>$x,'y'=>$y]);
    }




    /**
     * 获取一个图片
     */
    private function _getOnePic(){

        $pics=[];
        $pics[]="";

    }

}