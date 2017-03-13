<?php

/**
 * @var $this \yii\web\View
 */
$this->registerCssFile('@web/style/cart.css');
$this->registerJsFile('@web/js/cart1.js',['depends'=>\yii\web\JqueryAsset::className()]);
?>
<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="mycart w990 mt10 bc">
    <h2><span>我的购物车</span></h2>
    <table>
        <thead>
        <tr>
            <th class="col1">商品名称</th>
            <th class="col3">单价</th>
            <th class="col4">数量</th>
            <th class="col5">小计</th>
            <th class="col6">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0;?>
        <?php foreach($goodses as $goods):?>
            <?php $goods_total = $goods->shop_price*$goods->num;$total+=$goods_total; ?>
            <tr data-gid="<?=$goods->id?>">
                <td class="col1"><a href="<?=\yii\helpers\Url::to(['goods/detail','id'=>$goods->id])?>">
                        <?=\yii\helpers\Html::img($goods->logo)?>
                    </a>  <strong><?=\yii\helpers\Html::a($goods->name,['goods/detail','id'=>$goods->id])?></strong></td>
                <td class="col3">￥<span><?=$goods->shop_price?></span></td>
                <td class="col4">
                    <a href="javascript:;" class="reduce_num"></a>
                    <input type="text" name="amount" value="<?=$goods->num?>" class="amount"/>
                    <a href="javascript:;" class="add_num"></a>
                </td>
                <td class="col5">￥<span><?=number_format($goods_total,2,'.','')?></span></td>
                <td class="col6"><a class="del_goods" href="javascript:;">删除</a></td>
            </tr>
        <?php endforeach;?>

        </tbody>
        <tfoot>
        <tr>
            <td colspan="6">购物金额总计： <strong>￥ <span id="total"><?=number_format($total,2,'.','')?></span></strong></td>
        </tr>
        </tfoot>
    </table>
    <div class="cart_btn w990 bc mt10">
        <a href="" class="continue">继续购物</a>
        <a href="<?=\yii\helpers\Url::to(['cart/confirm'])?>" class="checkout">结 算</a>
    </div>
</div>
<!-- 主体部分 end -->
<?php
$this->registerJs('$(".del_goods").click(function(){
    var tr = $(this).closest("tr");
    $.post("'.\yii\helpers\Url::to(['cart/ajax','type'=>'del']).'",{goods_id:tr.attr("data-gid"),"_csrf-frontend":"'.Yii::$app->request->csrfToken.'"},function(data){
        console.log(data);
        if(data.status=="SUCCESS"){
            tr.remove();
        }else{
            console.log("删除失败");
        }
    },"json");

});');
?>
