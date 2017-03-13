<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'role')->checkboxList(\backend\models\AccessForm::getRolesItem());
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();