<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/24
 * Time: 15:15
 */

namespace frontend\controllers;


use frontend\models\Article;
use frontend\models\ArticleCategory;
use frontend\models\Goods;
use frontend\models\GoodsCategory;
use yii\web\Controller;

class GoodsController extends Controller
{
    public $goodsCategories;
    public $articleCategories;
    public $articleList;

    public $layout = 'common';
    public function actionDetail($id)
    {
        //读取分类
        $goodsCategories = GoodsCategory::find()->asArray(true)->all();
        $articleCategories = ArticleCategory::find()->select(['id','name'])->where(['is_help'=>1])->orderBy('sort')->limit(5)->all();
        $articleList = [];
        foreach($articleCategories as $category){
            $articleList[$category['id']] = Article::find()->where(['article_category_id'=>$category->id,'status'=>1])->orderBy('id')->limit(6)->all();
        }


        $this->goodsCategories = $goodsCategories;
        $this->articleCategories = $articleCategories;
        $this->articleList = $articleList;
        //获取商品详情
        $goodsDetail = Goods::findOne($id);
        return $this->render('detail',[
            'goodsDetail'=>$goodsDetail,
        ]);
    }
}