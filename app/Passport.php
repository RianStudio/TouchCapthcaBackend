<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    //


    public static function addAppPassport($userId){
        //随机生成key
        $k=substr(str_shuffle(md5(microtime())),rand(1,5),18);
        $v=substr(md5(str_shuffle(md5(microtime()))),rand(1,3),18);
        $model=new Passport();
        $model->user_id=$userId;
        $model->key=$k;
        $model->secret=$v;
        $model->save();

        $arr=[
            'k'=>$k,
            'v'=>$v,
        ];

        return $arr;
    }



    public static function checkPassport($k,$v){
        $find=Passport::where("key",$k)->where("secret",$v)->get();
        if(count($find) > 0){
            return $find[0]->user_id;
        }
        //没有结果,表示验证失败
        return false;
    }
}
