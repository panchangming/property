<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\models\GoodsCategory;

$form = ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'parent_id')->dropDownList(GoodsCategory::getCategories());

echo Html::submitInput('提交',['class'=>'btn btn-success','style'=>'margin-right:1em;']);
echo Html::resetInput('重置',['class'=>'btn btn-danger']);
ActiveForm::end();