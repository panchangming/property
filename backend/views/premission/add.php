<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'description')->textarea();
echo \yii\bootstrap\Html::submitInput('添加',[['premission/add'],'class'=>'btn btn-success']);
echo \yii\bootstrap\Html::resetButton('重置',['class'=>'btn btn-danger']);
\yii\bootstrap\ActiveForm::end();