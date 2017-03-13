<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'status')->radioList(['1'=>'正常','0'=>'禁用','-1'=>'删除']);
echo\yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();