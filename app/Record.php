<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //


    /**
     * 进行记录的保存
     */
    public static function AddRecord($create_verify,$void_verify,$user_id,$pic_original,$pic_background,$pic_button,$point_x,$point_y,$cookie_str){
        $model=new Record();
        $model->create_verify=$create_verify;
        $model->void_verify=$void_verify;
        $model->user_id=$user_id;
        $model->pic_original=$pic_original;
        $model->pic_background=$pic_background;
        $model->pic_button=$pic_button;
        $model->point_x=$point_x;
        $model->point_y=$point_y;
        $model->cookie_str=$cookie_str;
        $model->save();
        return $model->id;
    }

    /**
     * 删除记录
     */
    public static function DelRecord($id){
        return DB::table('records')->where('id', $id)->delete();
    }
}
