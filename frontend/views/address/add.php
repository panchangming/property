<!-- 页面主体 start -->
<?php
use yii\helpers\Url;
?>
<div class="main w1210 bc mt10">
    <div class="crumb w1210">
        <h2><strong>我的XX </strong><span>> 我的订单</span></h2>
    </div>

    <!-- 左侧导航菜单 start -->
    <div class="menu fl">
        <h3>我的XX</h3>
        <div class="menu_wrap">
            <dl>
                <dt>订单中心 <b></b></dt>
                <dd><b>.</b><a href="">我的订单</a></dd>
                <dd><b>.</b><a href="">我的关注</a></dd>
                <dd><b>.</b><a href="">浏览历史</a></dd>
                <dd><b>.</b><a href="">我的团购</a></dd>
            </dl>

            <dl>
                <dt>账户中心 <b></b></dt>
                <dd class="cur"><b>.</b><a href="">账户信息</a></dd>
                <dd><b>.</b><a href="">账户余额</a></dd>
                <dd><b>.</b><a href="">消费记录</a></dd>
                <dd><b>.</b><a href="">我的积分</a></dd>
                <dd><b>.</b><a href="">收货地址</a></dd>
            </dl>

            <dl>
                <dt>订单中心 <b></b></dt>
                <dd><b>.</b><a href="">返修/退换货</a></dd>
                <dd><b>.</b><a href="">取消订单记录</a></dd>
                <dd><b>.</b><a href="">我的投诉</a></dd>
            </dl>
        </div>
    </div>
    <!-- 左侧导航菜单 end -->

    <!-- 右侧内容区域 start -->
    <div class="content fl ml10">
        <div class="address_hd">
            <h3>收货地址薄</h3>
            <?php foreach($address as $row): ?>
              <?php     $row->status=$row->status==0?'':'默认地址';?>
                <?php if(count($address)==count($address)){
                    echo '<dl>';
                    echo '<dt>'."$row->id&nbsp$row->name&nbsp$row->provice&nbsp$row->city&nbsp$row->area&nbsp$row->ress&nbsp$row->tel&nbsp$row->status".'</dt>';
                    echo ' <dd>';
                    echo   \yii\helpers\Html::a('修改',['address/edit','id'=>$row->id]).'&nbsp';
                    echo   \yii\helpers\Html::a('删除',['address/delete','id'=>$row->id]).'&nbsp';
                    echo   \yii\helpers\Html::a('设置默认地址',['address/status','id'=>$row->id]);
                    echo ' </dd>';
                    echo ' </dl>';
                }else{
                    echo '<dl class="last">';
                    echo '<dt>'."$row->id&nbsp$row->name&nbsp$row->provice&nbsp$row->city&nbsp$row->area&nbsp$row->ress&nbsp$row->tel&nbsp$row->status".'</dt>';
                    echo ' <dd>';
                    echo '<a href="">修改</a>';
                    echo ' <a href="">删除</a>';
                    echo ' <a href="">设为默认地址</a>';
                    echo ' </dd>';
                    echo ' </dl>';
                }?>
            <?php  endforeach; ?>

        </div>

        <div class="address_bd mt10">
            <h4>新增收货地址</h4>
            <?php $form=\yii\widgets\ActiveForm::begin(
                [
                    'fieldConfig'=>[
                        'options'=>['tag'=>'li'],
                        'inputOptions'=>['class'=>'txt']

                    ]
                ]
            )?>
            <ul>
                <?=$form->field($model,'name')->textInput()?>

                    <?=$form->field($model,'provice',['inputOptions'=>['id'=>'provice']])->dropDownList(['prompt'=>'请选择省份'])?>
                    <?=$form->field($model,'city',['inputOptions'=>['id'=>'city']])->dropDownList(['prompt'=>'请选择市区'])?>
                    <?=$form->field($model,'area',['inputOptions'=>['id'=>'area']])->dropDownList(['prompt'=>'请选择县或者街道'])?>

                <?=$form->field($model,'ress',['inputOptions'=>['class'=>'txt address']])->textInput()?>
                <?=$form->field($model,'tel')->textInput()?>
                <?=$form->field($model,'status',['inputOptions'=>['class'=>'check']])->checkbox()?>


              </ul>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?=\yii\helpers\Html::submitInput('保存',['class'=>'btn'])?>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>

    </div>
    <!-- 右侧内容区域 end -->
</div>
<!-- 页面主体 end-->





<?php
/**
 * @var $this Yii\web\View
 */
use frontend\assets\CommonAsset;
CommonAsset::addScript($this,'@web/js/city.js');
CommonAsset::addCss($this,'@web/style/home.css');
CommonAsset::addCss($this,'@web/style/address.css');


$this->registerJs('$(mapCityChoice).each(function(k,provice){
        $("#provice").append("<option>"+provice.name+"</option>");
    });');
$this->registerJs('$("#provice").change(function(){
    $(mapCityChoice).each(function(k,provice){
        if($("#provice").val() == provice.name){
            $("#city").html("<option value>=请选择=</option>");
            $("#area").html("<option value>=请选择=</option>");
            $(provice.city).each(function(k,city){
                $("#city").append("<option>"+city.name+"</option>");
            });
        }
    });
});
$("#city").change(function(){
    $(mapCityChoice).each(function(k,provice){
        if($("#provice").val() == provice.name){
            $(provice.city).each(function(k,city){
                if($("#city").val() == city.name){
                    $("#area").html("<option value>=请选择=</option>");
                    $(city.area).each(function(k,area){
                        $("#area").append("<option>"+area+"</option>");
                    });
                }

            });
        }
    });
});',\yii\web\View::POS_END);
