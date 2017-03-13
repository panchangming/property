<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 15:45
 */

namespace backend\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class RoleForm extends  Model
{        const  SCENARIO_ADD='add';
         public  $name;
         public $description;
         public $permission;
    public  function  rules(){
        return [
            [['name','description','permission'],'required'],
            ['name','validateRole','on'=>self::SCENARIO_ADD]

        ];
    }
    public  function  attributeLabels(){
        return [
          'name'=>'角色名',
            'description'=>'角色简介',
            'permission'=>'权限选择',
        ];
    }
    public  function  validateRole($attribute,$params){
        if(\Yii::$app->authManager->getRule($this->attributeLabels())){
            $this->addError($attribute,'角色已存在');
        }

    }
    public static  function getPermissionList(){
        $authManager=\Yii::$app->authManager;
        $permission=$authManager->getPermissions();
        return ArrayHelper::map($permission,'name','description');
    }
   public  function  addRole(){
       $authManager=\Yii::$app->authManager;
       $role=$authManager->createRole($this->name);
       $role->description=$this->description;
       if($authManager->add($role)){
          foreach($this->permission as $value){
            $permission=$authManager->getPermission($value);
              $authManager->addChild($role,$permission);
          }
           return true;
       }
       return false;
   }
     public  function  loadRole($role){
         $authManager=\Yii::$app->authManager;
         $this->name=$role->name;
         $this->description=$role->description;
         $permission=$authManager->getPermissionsByRole($role->name);
        $this->permission=ArrayHelper::map($permission,'name','name');
     }

    /**更新角色,并删除对应的权限
     * @param $role
     */
    public  function  updateRole($role){
        $authManger=\Yii::$app->authManager;
        $this->description=$role->description;
        $authManger->update($this->name,$role);
        $authManger->removeChildren($role);
        foreach($this->permission as $value){
              $permission=$authManger->getPermission($value);
              $authManger->addChild($role,$permission);
        }
       return true;
    }
}