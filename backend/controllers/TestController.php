<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/18
 * Time: 10:47
 */

namespace backend\controllers;


use common\logic\NestedMysql;
use common\logic\NestedSets;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $db = new NestedMysql();
        new NestedSets();
    }

}