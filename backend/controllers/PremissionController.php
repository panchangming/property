<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 11:41
 */

namespace backend\controllers;

use backend\models\Goods;
use backend\models\PremissionForm;
use frontend\models\Brand;
use yii\data\Pagination;
use yii\web\Controller;

class PremissionController extends Controller
{
    public  function  actionIndex(){
        $allPermission=\Yii::$app->authManager->getPermissions();
         $count=count($allPermission);
        $size=5;

        $pager=new Pagination(['totalCount'=>$count,'defaultPageSize'=>$size]);
        return $this->render('index',['allPermission'=>$allPermission,'pager'=>$pager]);

    }
    public  function  actionAdd(){
        $model=new PremissionForm();
        if($model->load(\Yii::$app->request->post())&&$model->validate()){
             if($model->addPermission()) {
                 \Yii::$app->session->setFlash('success', '添加成功');
                 $this->redirect('index');
             }
        }
       return $this->render('add',['model'=>$model]);
    }
    public  function  actionEdit($name){

        $model=new PremissionForm();
           $model->editPermission($name);
        return $this->render('add',['model'=>$model]);

    }


}