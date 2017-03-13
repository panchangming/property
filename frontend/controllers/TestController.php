<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/5
 * Time: 16:48
 */

namespace frontend\controllers;


use yii\web\Controller;

class TestController extends Controller
{
    public  function  actionIndex(){

        \Yii::$app->mailer->compose()
            ->setFrom('18784352027@163.com')//发送者邮箱地址
            ->setTo('276412981@qq.com')//接收者的邮箱地址
            ->setSubject('关于Test的邮件')//邮件主题
            //->setTextBody('Plain text content')//文本类型的内容
            ->setHtmlBody('<b>success</b>')//HTML格式的文本内容
            ->send();
    }

}