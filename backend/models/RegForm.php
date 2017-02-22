<?php

/**
 * @link http://blog.kunx.org/.
 * @copyright Copyright (c) 2017-2-21 
 * @license kunx-edu@qq.com.
 */

namespace backend\models;

use yii\base\Model;

/**
 * Description of RegForm
 *
 * @author kunx <kunx-edu@qq.com>
 */
class RegForm extends Model {

    //put your code here
    public $username;
    public $password;
    public $repassword;
    public $email;

    public function rules() {
        return [
                [['username', 'password', 'repassword', 'email'], 'required'],
                ['email', 'email'],
                ['repassword', 'compare', 'compareAttribute' => 'password'],
                ['username', 'unique', 'targetClass' => Admin::className(), 'message' => '用户名已存在.'],
                ['email', 'unique', 'targetClass' => Admin::className(), 'message' => '邮箱已存在.'],
        ];
    }

    public function attributeLabels() {
        return [
            'username'   => '用户名',
            'password'   => '密码',
            'repassword' => '确认密码',
            'email'      => '邮箱',
        ];
    }

    public function reg() {
        if (!$this->validate()) {
            return false;
        }
        $model                       = new Admin();
        $model->auth_key             = \Yii::$app->security->generateRandomString();
        $model->password_reset_token = \Yii::$app->security->generateRandomString();
        $model->password_hash        = \Yii::$app->security->generatePasswordHash($this->password);
        $model->created_at           = time();
        $model->updated_at           = time();
        $model->username             = $this->username;
        $model->email                = $this->email;
        $model->status               = Admin::STATUS_ACTIVE;
        return $model->save();
    }

}
