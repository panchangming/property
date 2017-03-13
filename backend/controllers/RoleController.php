<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 15:36
 */

namespace backend\controllers;


use backend\models\RoleForm;
use yii\web\Controller;
use yii\web\HttpException;

class RoleController extends Controller
{
    /**主页显示
     * @return string
     */
    public  function  actionIndex(){
      $authManager=\Yii::$app->authManager;
        $roles=$authManager->getRoles();
        return $this->render('index',['roles'=>$roles]);
    }

    /**添加
     * @return string|\yii\web\Response
     */
    public  function  actionAdd(){
        $model=new RoleForm();
        $model->scenario=RoleForm::SCENARIO_ADD;
        if($model->load(\Yii::$app->request->post())&&$model->validate()){
            if($model->addRole()){
                \Yii::$app->session->setFlash('success','角色添加成功');
                return $this->redirect(['index']);
            }

        }


        return $this->render('add',['model'=>$model]);
    }

    /**修改角色
     * @param $name
     */
    public  function  actionEdit($name){

       $authManager=\Yii::$app->authManager;
        $role=$authManager->getRole($name);
        if($role==null){
            throw new HttpException(404,'该角色不存在');
        }
        $model=new RoleForm();
        $model->loadRole($role);
        if($model->load(\Yii::$app->request->post())&&$model->validate()){
          if($model->updateRole($role)){
             \Yii::$app->session->setFlash('success','修改成功');
              return $this->redirect(['index']);
          }
        }
        return $this->render('add',['model'=>$model]);
    }

    /**删除角色
     * @param $name
     */
    public  function  actionDelete($name){
        $authManager=\Yii::$app->authManager;
         $role=$authManager->getRole($name);
        if($role){
            $authManager->remove($role);
            \Yii::$app->session->setFlash('success','删除成功');
            $this->redirect(['index']);
        }else{
            throw new HttpException(404,'你的角色被绑架了');
        }

    }

}