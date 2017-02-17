<?php
/* @var $this yii\web\View */

$this->params['breadcrumbs'][] = [
    'label'=>'文章管理',
    'url'=>'index'
];
$this->params['breadcrumbs'][] = [
    'label'=>$articleModel->isNewRecord?'文章添加':'文章修改'
];

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
$form = ActiveForm::begin();
echo $form->field($articleModel,'name');
echo $form->field($articleModel,'article_category_id')->dropDownList(\backend\models\ArticleCategory::getArticleCategories(),['prompt'=>'请选择文章分类']);
echo $form->field($articleModel,'intro');
echo $form->field($articleDetailModel,'content')->textarea();
echo $form->field($articleModel,'sort');
echo $form->field($articleModel,'status')->dropDownList(['隐藏','正常'],['prompt'=>'请选择状态']);
echo Html::submitInput('提交',['class'=>'btn btn-primary','style'=>'margin-right:1em;']);
echo Html::resetInput('重置',['class'=>'btn btn-danger']);
ActiveForm::end();

