<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/24
 * Time: 11:28
 */

namespace frontend\models;



use yii\db\ActiveRecord;

class Goods extends ActiveRecord
{

    public static function getGoodsListByGoodsStatus($status)
    {
        //`goods_status &` 1
        return self::find()->select(['id','name','logo','shop_price'])->limit(5)->andWhere(['is_on_sale'=>1,'status'=>1])->where('goods_status & :status' , [':status'=>$status])->asArray(true)->all();
    }

    public function getContent()
    {
        return self::hasOne(GoodsIntro::className(),['goods_id'=>'id'])->select('content')->scalar();
    }

    public function getGallery()
    {
        return self::hasMany(GoodsGallery::className(),[['goods_id'=>'id']])->select('path')->asArray(true);
    }

    public function getBrand()
    {
        return self::hasOne(Brand::className(),['id'=>'brand_id'])->select('name')->scalar();
    }
}