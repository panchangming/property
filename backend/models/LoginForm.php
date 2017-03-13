<?php



namespace backend\models;
use yii\base\Model;


class LoginForm extends Model {

    //put your code here
    public $username;
    public $password;
    public $rememberMe = true;
    public $verify;

    public function rules() {
        return [
                [['username', 'password','verify'], 'required'],
            ['rememberMe','safe'],
            ['verify','captcha','captchaAction'=>'admin/captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'username'   => '用户名',
            'password'   => '密码',
            'verify'=>'验证码',
            'rememberMe'=>'记住密码'
        ];
    }

    public function login() {
        if (!$this->validate()) {
            return false;
        }
        $model = Admin::findOne(['username' => $this->username]);
        if (!$model) {
            $this->addError('username', '用户名或密码不匹配');
            return false;
        }
        if ($model->status != Admin::STATUS_ACTIVE) {
            $this->addError('username', '该用户被禁止登录');
            return false;
        }

        if (\Yii::$app->security->validatePassword($this->password, $model->password_hash)) {
            return \Yii::$app->user->login($model, $this->rememberMe ? 7*24 * 3600 : 0);
        } else {
            $this->addError('username', '用户名或密码不匹配');
            return false;
        }
    }

}
