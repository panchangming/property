<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\models\GoodsCategory;
use backend\assets\AppAsset;
use yii\web\View;

$form = ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
//echo $form->field($model,'parent_id')->dropDownList(GoodsCategory::getCategories(),['id'=>'parent-nodes']);
?>
<div class="form-group field-goodscategory-intro">
    <label class="control-label" for="parent-nodes">父级分类</label>
    <ul id="parent-nodes" class="ztree"></ul>
    <input type="hidden" name="GoodsCategory[parent_id]" id="parent-id"/>
    <p class="help-block help-block-error"></p>
</div>
<?php
echo Html::submitInput('提交',['class'=>'btn btn-success','style'=>'margin-right:1em;']);
echo Html::resetInput('重置',['class'=>'btn btn-danger']);
ActiveForm::end();

AppAsset::addCss($this,'@web/ext/ztree/css/demo.css?v=1');
AppAsset::addCss($this,'@web/ext/ztree/css/zTreeStyle/zTreeStyle.css');
AppAsset::addScript($this,'@web/ext/ztree/js/jquery.ztree.core.min.js');
$parentNodes = GoodsCategory::getCategories();

$jsStr = <<<EOF
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
                    $('#parent-id').val(node.id);
                }
            }
		};

		var zNodes = $parentNodes;

		$(document).ready(function(){
			var ztreeObj = $.fn.zTree.init($("#parent-nodes"), setting, zNodes);
			ztreeObj.expandAll(true);
		});
EOF;


$this->registerJs($jsStr, View::POS_END);

