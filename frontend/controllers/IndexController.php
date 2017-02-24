<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/24
 * Time: 10:31
 */

namespace frontend\controllers;


use frontend\models\Article;
use frontend\models\ArticleCategory;
use frontend\models\Goods;
use frontend\models\GoodsCategory;
use yii\web\Controller;

class IndexController extends Controller
{
    public $goodsCategories;
    public $articleCategories;
    public $articleList;

    public $layout = 'common';
    public function actionIndex()
    {
        //读取分类
        $goodsCategories = GoodsCategory::find()->asArray(true)->all();

        //读取商品促销列表
        //读取新品
        $newList = Goods::getGoodsListByGoodsStatus(1);
        //读取精品
        $bestList = Goods::getGoodsListByGoodsStatus(2);
        //读取热销
        $hotList = Goods::getGoodsListByGoodsStatus(4);


        //读取帮助文章的列表
        //1.取出帮助分类
        /**
         * [
         *  acid=>[
         *  []
         * ]
         * ]
         */
        $articleCategories = ArticleCategory::find()->select(['id','name'])->where(['is_help'=>1])->orderBy('sort')->limit(5)->all();
        $articleList = [];
        foreach($articleCategories as $category){
            $articleList[$category['id']] = Article::find()->where(['article_category_id'=>$category->id,'status'=>1])->orderBy('id')->limit(6)->all();
        }


        $this->goodsCategories = $goodsCategories;
        $this->articleCategories = $articleCategories;
        $this->articleList = $articleList;
        return $this->render('index',[
//            'goodsCategories'=>$goodsCategories,
            'newList'=>$newList,
            'bestList'=>$bestList,
            'hotList'=>$hotList,
//            'articleCategories'=>$articleCategories,
//            'articleList'=>$articleList,
        ]);
    }

    public function actionIndex2()
    {
        //读取分类
        $goodsCategories = GoodsCategory::find()->asArray(true)->all();

        //读取商品促销列表
        //读取新品
        $newList = Goods::getGoodsListByGoodsStatus(1);
        //读取精品
        $bestList = Goods::getGoodsListByGoodsStatus(2);
        //读取热销
        $hotList = Goods::getGoodsListByGoodsStatus(4);


        //读取帮助文章的列表
        $articleCategories = ArticleCategory::find()->with('articles')->select(['id','name'])->where(['is_help'=>1])->orderBy('sort')->limit(5)->all();


        return $this->renderPartial('index2',[
            'goodsCategories'=>$goodsCategories,
            'newList'=>$newList,
            'bestList'=>$bestList,
            'hotList'=>$hotList,
            'articleCategories'=>$articleCategories,
        ]);
    }
}