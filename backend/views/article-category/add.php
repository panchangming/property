<?php
/* @var $this yii\web\View */

$this->params['breadcrumbs'][] = [
    'label'=>'分类管理',
    'url'=>'index'
];
$this->params['breadcrumbs'][] = [
    'label'=>$model->isNewRecord?'分类添加':'分类修改'
];

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
$form = ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro');
echo $form->field($model,'sort');
echo $form->field($model,'status')->dropDownList(['隐藏','正常'],['prompt'=>'请选择状态']);
echo Html::submitInput('提交',['class'=>'btn btn-primary','style'=>'margin-right:1em;']);
echo Html::resetInput('重置',['class'=>'btn btn-danger']);
ActiveForm::end();

