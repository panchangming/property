<?php
namespace frontend\components;
use frontend\models\GoodsCategory;
use yii\base\Widget;

class GoodsCategoryWidget extends  Widget{
    public  function  init(){
                  parent::init();
    }
    public  function  run(){
        $isIndex=\Yii::$app->controller->id=='index' && \Yii::$app->controller->action->id=='index';
        parent::run();
        $goodsCategories=GoodsCategory::find()->asArray(true)->all();
        return $this->render('goods-category',['isIndex'=>$isIndex,'goodsCategories'=>$goodsCategories]);
    }
}