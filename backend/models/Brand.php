<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/16
 * Time: 15:30
 */

namespace backend\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Brand extends  ActiveRecord
{
    public function rules()
    {
        return [
            [['name','status'],'required'],
            [['sort','status'],'integer'],
            [['intro','logo'],'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'=>'品牌名称',
            'logo'=>'缩略图',
            'sort'=>'排序',
            'status'=>'状态',
            'intro'=>'简介'
        ];
    }

    public static function getBrands() {
        return ArrayHelper::map(self::find()->orderBy('sort')->where(['status' => 1])->all(), 'id', 'name');
    }
    public  static  function getListOne($id){
        $row=self::findOne(['id'=>$id]);
        return $row->name;
    }

}