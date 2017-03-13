<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 10:17
 */
namespace console\controllers;
use backend\models\Order;
use yii\console\Controller;

class TaskController  extends  Controller
{
    public  function  actionClean(){
        $result=Order::Clean();
        if($result=='success'){
            set_time_limit(0);
            while(true){
                echo date('Y-m-d H:i:s').'清理完成'."\n";
                sleep(10);
            }
        }else{
            echo date('Y-m-d H:i:s').'没有可清理的订单'."\n";
        }


    }

}