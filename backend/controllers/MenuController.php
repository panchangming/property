<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 9:38
 */

namespace backend\controllers;



use backend\models\Menu;
use yii\web\Controller;

class MenuController extends MembersController
{
    public  function  actionIndex(){
        $menu= Menu::findAll(['pid'=>0]);
        return $this->render('index',['menu'=>$menu]);

    }
    public  function  actionAdd(){
        $model=new Menu();
        if($model->load(\Yii::$app->request->post())&&$model->validate()){
            $model->save();
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['index']);
        }


        return $this->render('add',['model'=>$model]);
    }
    public  function actionEdit($id){
        $model=Menu::findOne($id);
        if($model->load(\Yii::$app->request->post())&&$model->validate()){
            $model->save();
            \Yii::$app->session->setFlash('success','修改成功');
            return $this->redirect(['index']);
        }


        return $this->render('add',['model'=>$model]);

    }
    public  function  actionDelete($id){
       if(Menu::findOne(['pid'=>$id])){
           Menu::deleteAll(['pid'=>$id]);
           Menu::deleteAll(['id'=>$id]);
       }else{
           Menu::deleteAll(['id'=>$id]);
       }
       return $this->redirect('index');
    }


}