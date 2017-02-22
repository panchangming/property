<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use xj\uploadify\Uploadify;
use yii\web\JsExpression;
use backend\models\GoodsCategory;
use backend\assets\AppAsset;
use yii\web\View;
use backend\models\Brand;

$form = ActiveForm::begin();
echo $form->field($goodsModel, 'name');
echo $form->field($goodsModel, 'brand_id')->dropDownList(Brand::getBrands(), ['prompt' => '请选择品牌']);
//echo $form->field($goodsModel, 'goods_category_id')->label(false)->hiddenInput(['id' => 'goods-category-id']);
echo $form->field($goodsModel, 'goods_category_id', ['template' => '<div class="form-group field-goodscategory-intro">
    {label}
    {input}
    <ul id="goods_category_ids" class="ztree"></ul>
    {error}{hint}
    </div>
    '])->textInput(['id' => 'goods-goods_category_id', 'style' => 'display:none']);
echo $form->field($goodsModel, 'logo')->widget(Uploadify::className(), [
    'url'       => Url::to(['upload/s-upload']),
    'csrf'      => true,
    'renderTag' => true,
    'id'        => 'goods-logo',
    'jsOptions' => [
        'width'           => 120,
        'height'          => 40,
        'buttonText'      => '选择文件',
        'buttonClass'     => 'bg-primary',
        'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        layer.msg(data.msg, {icon: 5});
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        layer.msg(data.msg, {icon: 6});
        $('#goods-logo').val(data.fileUrl);
        $('#goods-logo-preview').attr('src',data.fileUrl);
        $('#goods-logo-preview').show();
    }
}
EOF
        ),
    ]
]);
echo $form->field($goodsModel, 'logo')->label(false)->hiddenInput(['id' => 'goods-category-id']);
echo Html::img($goodsModel->logo, ['id' => 'goods-logo-preview', 'style' => 'max-width:100px', 'onerror' => 'this.style.display="none"']);

echo $form->field($goodsModel, 'market_price');
echo $form->field($goodsModel, 'shop_price');
echo $form->field($goodsModel, 'stock');
echo $form->field($goodsModel, 'sort');
echo $form->field($goodsModel, 'is_on_sale')->dropDownList(['下架', '在售'], ['prompt' => '请选择']);
//echo $form->field($goodsIntroModel, 'content')->textarea();
?>
<div class="form-group field-goodsgallery-path required">
    <label class="control-label" for="goodsgallery-path">相册</label>
    <input type="file" id="uploadify-box"/>
</div>
<?php
echo $form->field($goodsGalleryModel, 'path')->label(false)->widget(Uploadify::className(), [
    'url'       => Url::to(['upload/s-upload']),
    'id'        => 'uploadify-box',
    'csrf'      => true,
    'renderTag' => false,
    'jsOptions' => [
        'width'           => 120,
        'height'          => 40,
        'buttonText'      => '选择文件',
        'buttonClass'     => 'bg-primary',
        'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        layer.msg(data.msg, {icon: 5});
        console.log(data.msg);
    } else {
        var html = '<div style="margin-bottom:10px;"><img src="'+data.fileUrl+'" style="max-width:300px"/><input type="hidden" name="path[]" value="'+data.fileUrl+'"/><a href="javascript:;" onClick="$(this).parent().remove();">删除</a></div>'
        console.log(data.fileUrl);
        layer.msg(data.msg, {icon: 6});
        $(html).appendTo($('#pathes'));
    }
}
EOF
        ),
    ]
]);

$str = '';
echo Html::tag('div', $str, ['id' => 'pathes', 'style' => 'margin-bottom:1em']);


echo Html::submitInput('提交', ['class' => 'btn btn-success', 'style' => 'margin-right:1em']);
echo Html::resetInput('重置', ['class' => 'btn btn-danger']);


ActiveForm::end();



AppAsset::addCss($this, '@web/ext/ztree/css/demo.css?v=1');
AppAsset::addCss($this, '@web/ext/ztree/css/zTreeStyle/zTreeStyle.css');
AppAsset::addScript($this, '@web/ext/ztree/js/jquery.ztree.core.min.js');
AppAsset::addScript($this, '@web/ext/layer/layer.js');

$goodsCategories = json_encode(GoodsCategory::getCategories());
$jsStr           = <<<EOF
var setting = {
            data: {
                    simpleData: {
                            enable: true,
                            pIdKey:'parent_id',
                    }
            },
            callback: {
                onClick: function(event,treeEle,node){
                    console.debug(node);
                    $('#goods-category-id').val(node.id);
                    $('#goods-goods_category_id').val(node.id);
                }
            }
        };

var zNodes = $goodsCategories;

$(document).ready(function(){
        var ztreeObj = $.fn.zTree.init($("#goods_category_ids"), setting, zNodes);
        ztreeObj.expandAll(true);
});
EOF;


$this->registerJs($jsStr, View::POS_END);

