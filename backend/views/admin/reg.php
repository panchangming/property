<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

$form = ActiveForm::begin();
echo $form->field($model, 'username');
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'repassword')->passwordInput();
echo $form->field($model, 'email');
echo Html::submitInput('注册', ['class' => 'btn btn-success']);
ActiveForm::end();
