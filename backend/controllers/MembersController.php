<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 18:56
 */

namespace backend\controllers;


use backend\filters\AccessFilter;
use yii\web\Controller;

class MembersController extends  Controller
{
    public  function  behaviors(){
        return[
          'accessFilter'=>[
              'class'=>AccessFilter::className()
          ]
        ];
    }

}