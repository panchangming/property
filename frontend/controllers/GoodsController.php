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
use frontend\models\GoodsGallery;
use yii\web\Controller;
use frontend\models\Brand;
use yii\web\Request;



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
        $articleCategories = ArticleCategory::find()->select(['id', 'name'])->where(['is_help' => 1])->orderBy('sort')->limit(5)->all();
        $articleList = [];
        foreach ($articleCategories as $category) {
            $articleList[$category['id']] = Article::find()->where(['article_category_id' => $category->id, 'status' => 1])->orderBy('id')->limit(6)->all();
        }
        $goodsGallery = GoodsGallery::find()->where(['goods_id' => $id])->asArray(true)->all();

        $this->goodsCategories = $goodsCategories;
        $this->articleCategories = $articleCategories;
        $this->articleList = $articleList;
        //获取商品详情
        $goodsDetail = Goods::findOne($id);
        return $this->render('detail', [
            'goodsDetail' => $goodsDetail, 'goodsGallery' => $goodsGallery
        ]);
    }

    public function  actionList()
    {
        $request = new Request();
//        var_dump($request->get('max'));
//        var_dump($request->get('min'));
        //一级分类

        //二级分类

        //三级分类

        if (!empty($request->get('max') && $request->get('max'))) {
            $max = $request->get('max');
            $min = $request->get('min');
            $query = Goods::find();
            $goodsModel = $query->Where(['and', 'shop_price>' . $max, 'shop_price<' . $min])->all();

        } else

            if (!empty($request->get('brand'))) {
                $query = Goods::find();
                $brand = Brand::findOne(['name' => $request->get('brand')]);
                $goodsModel = $query->where(['brand_id' => $brand['id']])->all();

            } else {

                $query = Goods::find();
                $goodsModel = $query->where(['goods_category_id' => $request->get('id')])->all();
            }


        $brandModel = Brand::find()->select('name')->all();
        $goods_status = Goods::find()->where(['goods_status' => 2])->orderBy('id')->limit(3)->all();
        // var_dump($goods_status);exit;
        $status = Goods::find()->where(['goods_status' => 1])->orderBy('id')->limit(3)->all();
        return $this->render('list', ['goodsModel' => $goodsModel, 'brandModel' => $brandModel, 'goods_status' => $goods_status, 'status' => $status]);
        //  return $this->render('lsit');
    }
}