<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 19:18
 */

namespace backend\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class AccessForm extends Model
{
    public $role;
    public  function  attributeLabels(){
        return[
          'role'=>'角色'
        ];
    }
    public  function  rules(){
        return[
          ['role','required'],
        ];
    }
    public static function  getRolesItem(){
       $authManager=\Yii::$app->authManager;
        $roles=$authManager->getRoles();
        return ArrayHelper::map($roles,'name','description');
    }

}