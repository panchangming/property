<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use xj\uploadify\Uploadify;
use yii\web\JsExpression;
$form = ActiveForm::begin();
echo $form->field($model,'name')->textInput();

//外部TAG
echo Html::fileInput('logo', NULL, ['id' => 'logo-up']);
echo Uploadify::widget([
    'url' => yii\helpers\Url::to(['s-upload']),
    'id' => 'logo-up',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'width' => 120,
        'height' => 40,
        'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        layer.msg(data.msg, {icon: 5});
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        layer.msg(data.msg, {icon: 6});
        $('#logo-url').val(data.fileUrl);
    }
}
EOF
        ),
    ]
]);

echo Html::hiddenInput('logo','',['id'=>'logo-url']);




echo $form->field($model,'intro')->textarea();
echo $form->field($model,'sort')->textInput();
echo $form->field($model,'status')->dropDownList(['0'=>'隐藏','1'=>'正常'],['prompt'=>'请选择']);
echo Html::submitInput('提交',['class'=>'btn btn-success','style'=>'margin-right:1em']);
echo Html::resetInput('重置',['class'=>'btn btn-danger']);
ActiveForm::end();

use backend\assets\AppAsset;
AppAsset::addScript($this,'@web/ext/layer/layer.js');
