<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/5
 * Time: 9:50
 */

namespace frontend\controllers;


use frontend\models\Address;
use yii\web\Controller;
use yii\web\Request;

class AddressController  extends  Controller
{      public $layout = 'common';
    public  function actionAdd(){
       $model=new Address();
        $request=new Request();
       // var_dump($request->post());exit;
        if($model->load($request->post())&&$model->validate()){

            $model->save();
        }else{
         $model->getErrors();
        }
        $address=Address::find()->all();
        //$address=array_pop($address);
        return $this->render('add',['model'=>$model,'address'=>$address]);
    }
   public function actionStatus($id){
       $model=Address::findOne($id);
       $model->status=1;
       if($model->save()){
           return $this->redirect(['add']);
       }

   }
  public  function  actionDelete($id){
      $model=Address::deleteAll(['id'=>$id]);
      if($model){
          return $this->redirect(['add']);
      }else{

      }
  }
    public  function  actionEdit($id){
        $model=Address::findOne($id);
        $request=new Request();
        // var_dump($request->post());exit;
        if($model->load($request->post())&&$model->validate()){

            $model->save();
        }else{
            $model->getErrors();
        }
      //  $address=Address::find()->all();
        //$address=array_pop($address);
        return $this->render('edit',['model'=>$model]);
    }
}