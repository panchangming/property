<?php
$form=\yii\bootstrap\ActiveForm::begin();
if($model->scenario==\backend\models\RoleForm::SCENARIO_ADD){
    echo $form->field($model,'name')->textInput();
}else{
    echo $form->field($model,'name')->textInput(['disabled'=>true]);
}

echo $form->field($model,'description')->textarea();
echo $form->field($model,'permission')->checkboxList(\backend\models\RoleForm::getPermissionList());
echo \yii\bootstrap\Html::submitButton('提交',['role/add','class'=>'btn btn-success']);
echo \yii\bootstrap\Html::resetButton('重置',['class'=>'btn btn-danger']);
\yii\bootstrap\ActiveForm::end();
