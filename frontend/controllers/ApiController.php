<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/11
 * Time: 11:45
 */

namespace frontend\controllers;


use frontend\models\Member;
use yii\helpers\Json;
use yii\web\Controller;

class ApiController extends  Controller
{
    public  function  actionLogin($username,$pwd){
          $response=[
              'success'=>false,
              'errorMsg'=>'',
              'result'=>''

          ];
        $member=Member::findOne(['username'=>$username]);
        if($member){
            $password=\Yii::$app->security->validatePassword($pwd,$member->password);
            if($password){
                $response['success']=true;
                $response['result']=[
                 'id'=>$member->id,
                    'userName'=>$member->username,
                    'userIcon'=>'/user3.jpg',
                    'waitPayCount'=>1,
                    'waitReceiveCount'=>1,
                    'userLevel'=>1
                ];

//                "success": true,
//   "errorMsg": "",


//   "result": {
//                    "id": "用户id",
//       "userName": "用户名",
//       "userIcon": "头像路径",
//       "waitPayCount": 待付款数,
//       "waitReceiveCount": 待收货数,
//       "userLevel": 用户等级（1注册会员2铜牌会员3银牌会员4金牌会员5钻石会员）
              return  Json::encode($response);
            }

        }

    }
    public  function  actionSeckill(){
        $response=[
            'success'=>false,
            'errorMsg'=>'',
            'result'=>[
                1=>'total',
                2=>'rows'
            ]

        ];
        $response['success']=true;
        $response['result']=1;
        $response['rows']=[
            "allPrice"=>1000,
          "pointPrice"=>100,
          "iconUrl"=>'/user3.jpg',
          "timeLeft"=>60,
          "type"=>1,
          "productId"=>1
        ];
          return Json::encode($response);
    }
    public  function  actionBanner($adKind){

        $response=[
            'success'=>false,
            'errorMsg'=>'',
            'result'=>''
        ];
        $response['result']=[
            "id"=>1,
            "type"=>1,
           "adUrl"=>'/user3.jpg',
           "webUrl"=>'',
          "adKind"=>$adKind,
        ];
        return Json::encode($response);
    }
      public  function  actionGetyourfav(){
          $fav='fav';
          return Json::encode($fav);
    }


}