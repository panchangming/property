<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 10:31
 */

namespace backend\models;




use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public  static function  Clean(){
         $id=self::find()->select('id')->where(['<','create_time',time()])->all();
        if($id!=false){
            for($i=0;$i<=count($id);$i++){
                self::updateAll(['status'=>0],['id'=>$id]);
            }
            return 'success';
            exit;
        }else{
            return '已经清空';
        }


    }

}