<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/5
 * Time: 14:00
 */

namespace backend\controllers;


use backend\models\Member;
use yii\web\Controller;
use yii\web\Request;

class MemberController extends  Controller
{
    public  function  actionIndex(){
         $member=Member::find()->all();
        return $this->render('index',['member'=>$member]);
    }
    public  function  actionEdit($id){
        $model=Member::findOne($id);
        $request=new Request();
        if($model->load($request->post())&&$model->validate()){
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('edit',['model'=>$model]);
    }
    public  function  actionDelete($id){
        $model=Member::findOne($id);
        $model->status=-1;
        if($model->save()){
            return $this->redirect(['index']);
        }

    }

}