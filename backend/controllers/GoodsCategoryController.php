<?php

namespace backend\controllers;

use backend\models\GoodsCategory;

class GoodsCategoryController extends \yii\web\Controller
{
    public function actionAdd()
    {
        $model = new GoodsCategory();
        if(\Yii::$app->request->isPost){
            //收集数据
            $model->load(\Yii::$app->request->post());
            //执行添加
            if($model->addCategory()){
                //成功跳转
                return $this->redirect(['index']);
            }
        }
        return $this->render('add',[
            'model'=>$model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = GoodsCategory::findOne($id);

        //执行编辑
        if($model->deleteCategory($id)){
            //成功跳转
            return $this->redirect(['index']);
        }

    }

    /**
     * 修改商品分类。
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $model = GoodsCategory::findOne($id);
        if(\Yii::$app->request->isPost){
            //收集数据
            $model->load(\Yii::$app->request->post());
            //执行编辑
            if($model->modifyCategory()){
                //成功跳转
                return $this->redirect(['index']);
            }
        }
        return $this->render('add',[
            'model'=>$model,
        ]);
    }

    /**
     * 获取商品分类列表，无需分页
     * @return string
     */
    public function actionIndex()
    {
        //获取所有的商品分类
        $list = GoodsCategory::find()->orderBy('lft')->all();

        return $this->render('index',[
            'list'=>$list,
        ]);
    }

}
