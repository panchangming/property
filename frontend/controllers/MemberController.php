<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/3
 * Time: 11:37
 */

namespace frontend\controllers;


use frontend\models\LoginForm;
use frontend\models\Member;
use frontend\models\Time;
use yii\web\Controller;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;
use yii\web\Request;

class MemberController extends  Controller
{
    public $layout = 'member';
  public  function actionIndex(){
      echo 1;
  }
    public function actionSms(){

$tel=\Yii::$app->request->post('num',null);
//         $te=json_encode($tel);
//        echo $tel; exit;
        $code=rand(100000, 999999);
        $model=Time::findOne(['tel'=>$tel]);
        if($model==false){
            $time=new Time();
            $time->code=$code;
            $time->time=time();
            $time->count=0;
            $time->tel=$tel;
            $time->save();
        }
        if(date('d',$model->time)==date('d',time())){

        }else{
          $model->time=time();
           $model->update();
        }
        if($model->count>=3){
       //  echo '你当天的发送次数已用完';

        }
        if(date('i',time())-date('i',$model->time)<5){
             $code=$model->code;
        }
        $model->code=$code;
        $model->count=$model->count+1;
        $model->update();


// 配置信息
        $config = [
            'app_key'    => '23662023',
            'app_secret' => '839808e461c7d3423819d28239ab92b0',
            // 'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];
//
//
// 使用方法一

        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;
        $req->setRecNum($tel)
            ->setSmsParam([
                'code' => $code
            ])
            ->setSmsFreeSignName('潘昌明')
            ->setSmsTemplateCode('SMS_51970001');

        $resp = $client->execute($req);
          //\Yii::$app->session['tel']=$tel;
       if($resp){
           \Yii::$app->session->set('num',$tel);
           \Yii::$app->session->set('code',$code);
           echo 'success';
       }else{
           echo '你的电话号码输入错误';
       }
//
// 返回结果
       // print_r($resp);
//
//
    }
    public function actionReg()
    {
        $model = new Member(['scenario'=>Member::SCENARIO_REG]);

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //var_dump(\Yii::$app->session->get('code'));
            //var_dump($model);exit;
            $model->save(false);
            //var_dump($model);exit;
            return $this->redirect('login');
        }

        return $this->render('reg',['model'=>$model]);
    }
 public  function  actionLogin(){
     $model=new LoginForm();
     if ($model->load(\Yii::$app->request->post()) && $model->login()) {
         return $this->redirect(['member/index']);
     }

      return $this->render('login',['model'=>$model]);
 }
public  function  actionLogout(){
//    var_dump(\Yii::$app->user->identity);exit;
    \Yii::$app->user->logout();
}
}