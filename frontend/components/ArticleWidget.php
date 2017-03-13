<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/26
 * Time: 14:05
 */

namespace frontend\components;


use backend\models\ArticleCategory;
use yii\base\Widget;
use  frontend\models\Article;

class ArticleWidget  extends  Widget
{
    public  function  init(){
        parent::init();
    }
    public  function  run(){
        parent::run();

        $articleCategories = ArticleCategory::find()->select(['id','name'])->where(['is_help'=>1])->orderBy('sort')->limit(5)->all();
        $articleList = [];
        foreach($articleCategories as $category){
            $articleList[$category['id']] = Article::find()->where(['article_category_id'=>$category->id,'status'=>1])->orderBy('id')->limit(6)->all();
        }

        return $this->render('article',['articleCategories'=>$articleCategories,'articleList'=>$articleList]);
    }

}