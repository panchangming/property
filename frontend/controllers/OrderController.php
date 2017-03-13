<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 15:49
 */

namespace frontend\controllers;


use yii\web\Controller;

class OrderController extends  Controller
{
    public  $layout='flow1';
    public  function  actionAdd(){
        return $this->render('index');
    }

}