<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 12:42
 */

namespace backend\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class PremissionForm extends Model
{
    public  $name;
    public $description;
    public  function  rules(){
        return [
          [['name','description'],'required'],
            ['name','validatePermission']
        ];
    }
    public  function  attributeLabels(){
        return[
          'name'=>'权限名称',
            'description'=>'权限介绍'
        ];
    }
    public  function  addPermission(){
        $authManager=\Yii::$app->authManager;
        $permission=$authManager->createPermission($this->name);
        $permission->description=$this->description;
        return $authManager->add($permission);
    }
    public  function  validatePermission($attribute,$params){
       if(\Yii::$app->authManager->getPermission($this->attributeLabels())){
               $this->addError($attribute,'该权限已存在');
       }

    }
    public  function  editPermission($name){
       $authManager=\Yii::$app->authManager;
       $authManage= $authManager->getPermission($name);
        return $authManage;
    }


}