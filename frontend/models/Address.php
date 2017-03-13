<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/5
 * Time: 9:52
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Address extends ActiveRecord
{
 public  function rules(){
     return[
       [['name','provice','city','area','ress','tel'],'required'],
         ['status','safe']
     ];
 }
    public function attributeLabels() {
        return[
          'name'=>'*收  货  人:',
           'ress'=>'详细地址',
            'tel'=>'手机号码',
            'provice'=>'省:',
            'city'=>'市：',
            'area'=>'县：',
            'status'=>'设为默认地址'
        ];
    }
    public static function getAddressOptions()
    {
        $result = [];
        //获取当前用户的收货地址
        $addresses = Address::find()->where(['member_id'=>\Yii::$app->user->id])->orderBy('status DESC')->asArray()->all();
        foreach($addresses as $address){
            $data=[
                $address['name'],$address['tel'],$address['provice'],$address['city'],$address['area'],$address['ress']
            ];
            $result[$address['id']]=implode(' ',$data);
        }
        return $result;
    }

}