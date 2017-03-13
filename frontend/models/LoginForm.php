<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/4
 * Time: 16:18
 */

namespace frontend\models;


use yii\base\Model;
use yii\web\Request;

class LoginForm  extends  Model
{
      public  $username;
      public  $password;
    public $rememberMe = true;
      public  $captcha;
    public function rules() {
        return [
            [['username', 'password','captcha'], 'required'],
            ['rememberMe','safe'],
            ['captcha','captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'username'   => '用户名',
            'password'   => '密码',
            'captcha'=>'验证码',
            'rememberMe'=>''
        ];
    }
    public function login() {
        if (!$this->validate()) {
            return false;
        }
        $model = Member::findOne(['username' => $this->username]);
       // var_dump($model->status);exit;
        if (!$model) {
            $this->addError('username', '用户名或密码不匹配');
            return false;
        }
        if ($model->status != Member::STATUS_ACTIVE) {
            $this->addError('username', '该用户被禁止登录');
            return false;
        }

        if (\Yii::$app->security->validatePassword($this->password, $model->password)) {
            $model->last_login_time=time();
            $request=new Request();
            $model->last_login_ip=$request->userIP;
            $model->update(false);
            return  \Yii::$app->user->login($model, $this->rememberMe ? 7*24 * 3600 : 0);
           // var_dump(\Yii::$app->user->identity);


        } else {
            $this->addError('username', '用户名或密码不匹配');
            return false;
        }
    }

}