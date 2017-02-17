<?php

namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\data\Pagination;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionAdd()
    {
        $model = new ArticleCategory();
        //判断是否提交
        if(\Yii::$app->request->isPost){
            //获取数据
            $model->load(\Yii::$app->request->post());
            //验证数据,执行添加
            if($model->save()){
                //跳转
                return $this->redirect(['index']);
            }
        }
        return $this->render('add',[
            'model'=>$model
        ]);
    }

    public function actionDelete($id)
    {
        $model = ArticleCategory::findOne($id);
        $model->status = 0;
        if($model->save()){
            //跳转
            return $this->redirect(['index']);
        }
    }

    public function actionEdit($id)
    {
        $model = ArticleCategory::findOne($id);
        //判断是否提交
        if(\Yii::$app->request->isPost){
        //获取数据
        $model->load(\Yii::$app->request->post());
        //验证数据,执行保存
        if($model->save()){
            //跳转
            return $this->redirect(['index']);
        }
    }
        return $this->render('add',[
            'model'=>$model
        ]);
    }

    public function actionIndex()
    {
        $query = ArticleCategory::find();
        $pages = new Pagination(['totalCount'=>$query->count()]);
        $list = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'pages'=>$pages,
            'list'=>$list,
        ]);
    }

}
