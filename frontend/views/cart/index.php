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
    <?php foreach($model as $cart):?>
    <tr>
        <td class="col1"><a href=""><img src="<?=\frontend\models\Goods::getGoodsAll($cart['goods_id'])['logo']?>" alt="" /></a>  <strong><a href=""><?=\frontend\models\Goods::getGoodsAll($cart['goods_id'])['name']?></a></strong></td>
        <td class="col3">￥<span><?=\frontend\models\Goods::getGoodsAll($cart['goods_id'])['shop_price']?></span></td>
        <td class="col4">
            <a href="javascript:;" class="reduce_num"></a>
            <input type="text" name="amount" value="<?=$cart['amount']?>" class="amount"/>
            <a href="javascript:;" class="add_num"></a>
        </td>
        <td class="col5">￥<span><?=\frontend\models\Goods::getGoodsAll($cart['goods_id'])['shop_price']*$cart['amount']?></span></td>
        <td class="col6"><a href="javascript:;" class='del'>删除</a></td>
    </tr>
    <?php   endforeach;?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">购物金额总计： <strong>￥ <span id="total">1870.00</span></strong></td>
    </tr>
    </tfoot>
</table>
<div class="cart_btn w990 bc mt10">
    <a href="" class="continue">继续购物</a>
    <a href="" class="checkout">结 算</a>
</div>
<script>
//    window.onload= function () {
//        console.log(111)
//        $('.del').click(function () {
//
//        })
//    }
</script>
<?php
/**
 * @var $this  yii\web\View
 */
if(\Yii::$app->user->isGuest){
    $this->registerJs(
        '

  $(".del").click(function(){
        $(this).parent().parent().remove()
        $.get("'.\yii\helpers\Url::to(["cart/delete"]).'",{id:'.$cart['id'].'},function(data){

               if(data=="success"){

               }else{
               alter(data)

               }

        })
}
  )

');
}

