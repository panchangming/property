<?php
$this->registerCssFile('@web/style/fillin.css');
?>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">

        <div class="flow fr flow2">
            <ul>
                <li>1.我的购物车</li>
                <li class="cur">2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>

<!-- 主体部分 start -->
<div class="fillin w990 bc mt15">
    <?php $form=\yii\widgets\ActiveForm::begin()?>
    <div class="fillin_hd">
        <h2>填写并核对订单信息</h2>
    </div>

    <div class="fillin_bd">

        <!-- 收货人信息  start-->
        <div class="address">
            <h3>收货人信息 <a href="javascript:;" id="address_modify"></a></h3>
            <?php // echo $form->field($model,'address_id',['template' => "{input}"])->radioList(\frontend\models\Address::getAddressOptions())?>
            <?php foreach(\frontend\models\Address::getAddressOptions() as $aid=>$addess):?>
            <p><?=\yii\helpers\Html::input('radio','Order[address_id]',$aid).$addess?></p>
            <?php endforeach;?>
        </div>
        <!-- 收货人信息  end-->

        <!-- 配送方式 start -->
        <div class="delivery">
            <h3>送货方式 <a href="javascript:;" id="delivery_modify"></a></h3>
            <div class="delivery_info">
                <?php foreach(\frontend\models\Order::$delivarys as $did=>$delivary):?>
                <p><?=\yii\helpers\Html::input('radio','Order[delivary_id]',$did).$delivary?></p>
                <?php endforeach;?>

            </div>


        </div>
        <!-- 配送方式 end -->

        <!-- 支付方式  start-->
        <div class="pay">
            <h3>支付方式 <a href="javascript:;" id="pay_modify">[修改]</a></h3>
            <div class="pay_info">
                <?php foreach(\frontend\models\Order::$payments as $pid=>$payment):?>
                    <p><?=\yii\helpers\Html::input('radio','Order[pay_type_id]',$pid).$payment?></p>
                <?php endforeach;?>
            </div>
        </div>
        <!-- 支付方式  end-->

        <!-- 发票信息 start-->

        <!-- 发票信息 end-->

        <!-- 商品清单 start -->
        <div class="goods">
            <h3>商品清单</h3>
            <table>
                <thead>
                <tr>
                    <th class="col1">商品</th>
                    <th class="col3">价格</th>
                    <th class="col4">数量</th>
                    <th class="col5">小计</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="col1"><a href=""><img src="images/cart_goods1.jpg" alt="" /></a>  <strong><a href="">【1111购物狂欢节】惠JackJones杰克琼斯纯羊毛菱形格</a></strong></td>
                    <td class="col3">￥499.00</td>
                    <td class="col4"> 1</td>
                    <td class="col5"><span>￥499.00</span></td>
                </tr>
                <tr>
                    <td class="col1"><a href=""><img src="images/cart_goods2.jpg" alt="" /></a> <strong><a href="">九牧王王正品新款时尚休闲中长款茄克EK01357200</a></strong></td>
                    <td class="col3">￥1102.00</td>
                    <td class="col4">1</td>
                    <td class="col5"><span>￥1102.00</span></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <ul>
                            <li>
                                <span>4 件商品，总商品金额：</span>
                                <em>￥5316.00</em>
                            </li>
                            <li>
                                <span>返现：</span>
                                <em>-￥240.00</em>
                            </li>
                            <li>
                                <span>运费：</span>
                                <em>￥10.00</em>
                            </li>
                            <li>
                                <span>应付总额：</span>
                                <em>￥5076.00</em>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- 商品清单 end -->

    </div>

    <div class="fillin_ft">
        <a href=""><span>提交订单</span></a>
        <input type="submit" class="btn_submit" value="提交表单">
        <p>应付总额：<strong>￥5076.00元</strong></p>

    </div>
    <?php \yii\widgets\ActiveForm::end()?>
</div>
<!-- 主体部分 end -->