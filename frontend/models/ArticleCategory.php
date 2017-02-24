<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/24
 * Time: 14:05
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class ArticleCategory extends ActiveRecord
{

    public function getArticles()
    {
        return $this->hasMany(Article::className(),['article_category_id'=>'id'])->limit(6)->where(['status'=>1]);
    }
}