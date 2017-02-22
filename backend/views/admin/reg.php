<?php

/** 
 * @link http://blog.kunx.org/.
 * @copyright Copyright (c) 2017-2-21 
 * @license kunx-edu@qq.com.
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

$form = ActiveForm::begin();
echo $form->field($model, 'username');
echo $form->field($model, 'password');
echo $form->field($model, 'repassword');
echo $form->field($model, 'email');
echo Html::submitInput('注册', ['class' => 'btn btn-success']);
ActiveForm::end();
