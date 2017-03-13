
    <div class="fillin_hd">
        <h2>填写并核对订单信息</h2>
    </div>

    <div class="fillin_bd">
        <!-- 收货人信息  start-->
        <div class="address">
            <h3>收货人信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>
            <div class="address_info">
                <p>
                    <input type="radio" value="1" name="address_id"/>
                    <?=\frontend\models\Address::getRess()['name']?>&nbsp;
                    <?=\frontend\models\Address::getRess()['tel']?>&nbsp;
                    <?=\frontend\models\Address::getRess()['provice']?>&nbsp;
                    <?=\frontend\models\Address::getRess()['city']?>&nbsp;
                    <?=\frontend\models\Address::getRess()['area']?>&nbsp;
                    <?=\frontend\models\Address::getRess()['ress']?>
                </p>
                <input type="radio" value="1" name="address_id"/>许坤  17002810530  四川省 成都市 高新区 仙人跳大街 </p>
            </div>

            <div class="address_select none">
                <ul>
                    <li class="cur">
                        <input type="radio" name="address" checked="checked" />王超平 北京市 昌平区 建材城西路金燕龙办公楼一层 13555555555
                        <a href="">设为默认地址</a>
                        <a href="">编辑</a>
                        <a href="">删除</a>
                    </li>
                    <li>
                        <input type="radio" name="address"  />王超平 湖北省 武汉市  武昌 关山光谷软件园1号201 13333333333
                        <a href="">设为默认地址</a>
                        <a href="">编辑</a>
                        <a href="">删除</a>
                    </li>
                    <li><input type="radio" name="address" class="new_address"  />使用新地址</li>
                </ul>
                <form action="" class="none" name="address_form">
                    <ul>
                        <li>
                            <label for=""><span>*</span>收 货 人：</label>
                            <input type="text" name="" class="txt" />
                        </li>
                        <li>
                            <label for=""><span>*</span>所在地区：</label>
                            <select name="" id="">
                                <option value="">请选择</option>
                                <option value="">北京</option>
                                <option value="">上海</option>
                                <option value="">天津</option>
                                <option value="">重庆</option>
                                <option value="">武汉</option>
                            </select>

                            <select name="" id="">
                                <option value="">请选择</option>
                                <option value="">朝阳区</option>
                                <option value="">东城区</option>
                                <option value="">西城区</option>
                                <option value="">海淀区</option>
                                <option value="">昌平区</option>
                            </select>

                            <select name="" id="">
                                <option value="">请选择</option>
                                <option value="">西二旗</option>
                                <option value="">西三旗</option>
                                <option value="">三环以内</option>
                            </select>
                        </li>
                        <li>
                            <label for=""><span>*</span>详细地址：</label>
                            <input type="text" name="" class="txt address"  />
                        </li>
                        <li>
                            <label for=""><span>*</span>手机号码：</label>
                            <input type="text" name="" class="txt" />
                        </li>
                    </ul>
                </form>
                <a href="" class="confirm_btn"><span>保存收货人信息</span></a>
            </div>
        </div>
        <!-- 收货人信息  end-->

        <!-- 配送方式 start -->
        <div class="delivery">
            <h3>送货方式 <a href="javascript:;" id="delivery_modify">[修改]</a></h3>
            <div class="delivery_info">
                <p>普通快递送货上门</p>
                <p>送货时间不限</p>
            </div>

            <div class="delivery_select none">
                <table>
                    <thead>
                    <tr>
                        <th class="col1">送货方式</th>
                        <th class="col2">运费</th>
                        <th class="col3">运费标准</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="cur">
                        <td>
                            <input type="radio" name="delivery" checked="checked" />普通快递送货上门
                            <select name="" id="">
                                <option value="">时间不限</option>
                                <option value="">工作日，周一到周五</option>
                                <option value="">周六日及公众假期</option>
                            </select>
                        </td>
                        <td>￥10.00</td>
                        <td>每张订单不满499.00元,运费15.00元, 订单4...</td>
                    </tr>
                    <tr>

                        <td><input type="radio" name="delivery" />特快专递</td>
                        <td>￥40.00</td>
                        <td>每张订单不满499.00元,运费40.00元, 订单4...</td>
                    </tr>
                    <tr>

                        <td><input type="radio" name="delivery" />加急快递送货上门</td>
                        <td>￥40.00</td>
                        <td>每张订单不满499.00元,运费40.00元, 订单4...</td>
                    </tr>
                    <tr>

                        <td><input type="radio" name="delivery" />平邮</td>
                        <td>￥10.00</td>
                        <td>每张订单不满499.00元,运费15.00元, 订单4...</td>
                    </tr>
                    </tbody>
                </table>
                <a href="" class="confirm_btn"><span>确认送货方式</span></a>
            </div>
        </div>
        <!-- 配送方式 end -->

        <!-- 支付方式  start-->
        <div class="pay">
            <h3>支付方式 <a href="javascript:;" id="pay_modify">[修改]</a></h3>
            <div class="pay_info">
                <p>货到付款</p>
            </div>

            <div class="pay_select none">
                <table>
                    <tr class="cur">
                        <td class="col1"><input type="radio" name="pay" />货到付款</td>
                        <td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />在线支付</td>
                        <td class="col2">即时到帐，支持绝大数银行借记卡及部分银行信用卡</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />上门自提</td>
                        <td class="col2">自提时付款，支持现金、POS刷卡、支票支付</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />邮局汇款</td>
                        <td class="col2">通过快钱平台收款 汇款后1-3个工作日到账</td>
                    </tr>
                </table>
                <a href="" class="confirm_btn"><span>确认支付方式</span></a>
            </div>
        </div>
        <!-- 支付方式  end-->

        <!-- 发票信息 start-->
        <div class="receipt">
            <h3>发票信息 <a href="javascript:;" id="receipt_modify">[修改]</a></h3>
            <div class="receipt_info">
                <p>个人发票</p>
                <p>内容：明细</p>
            </div>

            <div class="receipt_select none">
                <form action="">
                    <ul>
                        <li>
                            <label for="">发票抬头：</label>
                            <input type="radio" name="type" checked="checked" class="personal" />个人
                            <input type="radio" name="type" class="company"/>单位
                            <input type="text" class="txt company_input" disabled="disabled" />
                        </li>
                        <li>
                            <label for="">发票内容：</label>
                            <input type="radio" name="content" checked="checked" />明细
                            <input type="radio" name="content" />办公用品
                            <input type="radio" name="content" />体育休闲
                            <input type="radio" name="content" />耗材
                        </li>
                    </ul>
                </form>
                <a href="" class="confirm_btn"><span>确认发票信息</span></a>
            </div>
        </div>
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
                <?php foreach(\frontend\models\Cart::getOrder() as $row):?>
                <tr>
                    <td class="col1"><a href=""><img src="<?=\frontend\models\Goods::getGoodsAll($row->goods_id)['logo']?>" alt="" /></a>  <strong><a href=""><?=\frontend\models\Goods::getGoodsAll($row->goods_id)['name']?></a></strong></td>
                    <td class="col3">￥<?=\frontend\models\Goods::getGoodsAll($row->goods_id)['shop_price']?></td>
                    <td class="col4"> <?=$row['amount']?></td>
                    <td class="col5"><span>￥<?=\frontend\models\Goods::getGoodsAll($row->goods_id)['shop_price']*$row['amount']?>></td>
                </tr>
                <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <ul>
                            <li>
                                <span><?=count(\frontend\models\Cart::getOrder())?> 件商品，总商品金额：</span><em>￥
                                    <?php
                                    $arr=[];

                                    for($i=1;$i<count(\frontend\models\Cart::getOrder());$i++){
                                        $arr[]=\frontend\models\Goods::getGoodsAll(\frontend\models\Cart::getOrder()['goods_id'])['shop_price']*\frontend\models\Cart::getOrder()['amount'];
                                    }
                                    echo array_sum($arr);

                                    ?>

                                    5316.00</em>

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
        <p>应付总额：<strong>￥5076.00元</strong></p>

    </div>
</div>
<?php
/**
 * @var $this yii\web\view
 */
$this->registerJsFile('@web/js/cart2.js');
$this->registerCssFile('@web/style/fillin.css');