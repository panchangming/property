<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/16
 * Time: 14:30
 */

namespace backend\controllers;


use backend\models\Brand;
use yii\web\Controller;

class BrandController extends Controller
{
    /**
     * 列表页面
     * @return string
     */
    public function actionIndex()
    {
        //获取品牌列表
        $list = Brand::find()->where(['<>','status',-1])->all();
        return $this->render('index',[
            'list'=>$list
        ]);
    }

    public function actionAdd()
    {
        //创建模型对象，并传递给视图
        $model = new Brand();
        //判断是否提交
        if(\Yii::$app->request->isPost){
            //获取数据
            $model->load(\Yii::$app->request->post());
            //验证数据,执行添加
            if($model->save()){
                //跳转
                $this->redirect(['index']);
            }
        }
        return $this->render('add',[
            'model'=>$model,
        ]);
    }

    public function actionEdit($id)
    {
        //获取品牌对象
        $model = Brand::findOne($id);
        //判断是否提交
        if(\Yii::$app->request->isPost){
            //获取数据
            $model->load(\Yii::$app->request->post());
            //验证数据,执行保存
            if($model->save()){
                //跳转
                $this->redirect(['index']);
            }
        }
        //渲染视图
        return $this->render('add',[
            'model'=>$model,
        ]);
    }

    /**
     * 删除品牌，逻辑删除
     * @param $id
     */
    public function actionDelete($id)
    {
        //获取品牌修改字段
        $model = Brand::findOne($id);
        $model->status = -1;
        if($model->save()){
            //跳转
            $this->redirect(['index']);
        }

    }
}