<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

$form = ActiveForm::begin();
echo $form->field($model, 'username');
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'verify')->widget(\yii\captcha\Captcha::className(),[
    'captchaAction'=>'admin/captcha',
    'template'=>'<br />{image}{input}',
]);
echo $form->field($model, 'rememberMe')->checkbox();

echo Html::submitInput('登录', ['class' => 'btn btn-success' ]);

echo Html::a('点击这里进行注册',['reg']);
ActiveForm::end();
