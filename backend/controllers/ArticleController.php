<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleDetail;
use yii\data\Pagination;

class ArticleController extends \yii\web\Controller
{
    public function actionAdd()
    {
        $articleModel = new Article();
        $articleDetailModel = new ArticleDetail();
        //判断是否提交
        if(\Yii::$app->request->isPost){
            //获取数据
            $articleModel->load(\Yii::$app->request->post());
            $articleDetailModel->load(\Yii::$app->request->post());
            //验证数据,执行添加
            if($rst = $articleModel->save()){
                $article_id = $articleModel->primaryKey;
                $articleDetailModel->article_id = $article_id;
                if($articleDetailModel->save()){
                    //跳转
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add',[
            'articleModel'=>$articleModel,
            'articleDetailModel'=>$articleDetailModel,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Article::findOne($id);
        $model->status = 0;
        if($model->save()){
            //跳转
            return $this->redirect(['index']);
        }
    }

    /**
     * 编辑文章。
     * tips：当然可以使用关联模型进行关联操作，但是初期以夯实基础，学会解决实际问题为主。
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $articleModel = Article::findOne($id);
        $articleDetailModel = ArticleDetail::find()->where(['article_id'=>$id])->one();
        //判断是否提交
        if(\Yii::$app->request->isPost){
            //获取数据
            $articleModel->load(\Yii::$app->request->post());
            $articleDetailModel->load(\Yii::$app->request->post());
            //验证数据,执行添加
            if($rst = $articleModel->save()){
                //基本信息保存完毕，还需要保存关联数据。
                if($articleDetailModel->updateAll($articleDetailModel->getAttributes(),['article_id'=>$id])){
                    //跳转
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add',[
            'articleModel'=>$articleModel,
            'articleDetailModel'=>$articleDetailModel,
        ]);
    }

    /**
     * 文章列表
     * @return string
     */
    public function actionIndex()
    {
        $query = Article::find();
        $pages = new Pagination(['totalCount'=>$query->count()]);
        $list = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'pages'=>$pages,
            'list'=>$list,
        ]);
    }

}
