<?php
use  backend\assets\AppAsset;

$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'route');
echo $form->field($model,'description')->textarea();
echo $form->field($model,'pid')->hiddenInput();
echo \backend\widgets\ZtreeWidget::widget(
    [
        'setting'=>'{
            data: {
                    simpleData: {
                            enable: true,
                            pIdKey:"pid",
                    }
            },
            callback: {
                onClick: function(event,treeEle,node){
                    $("#menu-pid").val(node.id);
                }
            }
        }',
        'zNodes'=>\backend\models\Menu::getMenu(),
          'selectNodes'=>['id'=>$model->id]
    ]
);
echo $form->field($model,'img')->dropDownList([''=>'请选择','laptop'=>'商品','home'=>'主页','book'=>'订单','cogs'=>'会员','envelope'=>'文章','tasks'=>'系统']);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-info']);
echo \yii\bootstrap\Html::resetButton('重置',['class'=>'btn btn-danger']);
\yii\bootstrap\ActiveForm::end();

