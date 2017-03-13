<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 16:47
 */

namespace backend\filters;


use yii\base\ActionFilter;
use yii\web\HttpException;

class AccessFilter extends ActionFilter
{
    public  function beforeAction($action){
        //判断用户是否登录
        if(\Yii::$app->user->isGuest){
            $action->controller->redirect(['admin/login']);
        }
        if(!\Yii::$app->user->can($action->uniqueId)){
          throw new HttpException(403,'你没有操作权限');
        }
        return parent::beforeAction($action);
    }

}