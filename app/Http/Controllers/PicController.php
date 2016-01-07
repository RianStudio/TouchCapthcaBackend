<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libs\ImageCrop;

class PicController extends Controller
{



    /**
     *
     * 输出图片
     * @param Request $request
     */
    function output(Request $request){
        //模拟接收kv


        //模拟根据返回相关图片

        $s= $request->get('s');

        //根据参数状态返回对于的图片
        $pathToFile="./pic/a.jpg";

        if($s == 1){

            //模拟输出完整图片
            return response()->download($pathToFile);

        }

        if($s == 2){



//            var_dump($ic);
//
//            $ic->Crop(120,80,2);
            $ic=new ImageCrop($pathToFile,'./pic/afterCrop'.time().'.jpg');
            $ic->Cut(40,30,120,130);
             $ic->SaveImage();
                    //$ic->SaveAlpha();将补白变成透明像素保存
             $ic->destory();

            //模拟输出裁剪之后的图片
        }


    }


    /**
     * 返回当前用户的当前请求的图片校验坐标
     * @param Request $request
     */
    public function xy(Request $request){


    }




    /**
     * 获取一个图片
     */
    private function _getOnePic(){

        $pics=[];
        $pics[]="";

    }

}
