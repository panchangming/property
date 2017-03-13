<body>
<!-- 顶部导航 start -->

<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 头部 start -->

        <!-- 头部搜索 end -->

        <!-- 用户中心 start-->

    <!-- 头部上半部分 end -->



    <!-- 导航条部分 start -->

        <!--  商品分类部分 start-->



        <!--  商品分类部分 end-->


<!-- 头部 end-->



<!-- 列表主体 start -->
<div class="list w1210 bc mt10">
    <!-- 面包屑导航 start -->
    <div class="breadcrumb">
        <h2>当前位置：<a href="">首页</a> > <a href="">电脑、办公</a></h2>
    </div>
    <!-- 面包屑导航 end -->

    <!-- 左侧内容 start -->
    <div class="list_left fl mt10">
        <!-- 分类列表 start -->
        <div class="catlist">
            <h2>电脑、办公</h2>
            <div class="catlist_wrap">
                <div class="child">
                    <h3 class="on"><b></b>电脑整机</h3>
                    <ul>
                        <li><a href="">笔记本</a></li>
                        <li><a href="">超极本</a></li>
                        <li><a href="">平板电脑</a></li>
                    </ul>
                </div>

                <div class="child">
                    <h3><b></b>电脑配件</h3>
                    <ul class="none">
                        <li><a href="">CPU</a></li>
                        <li><a href="">主板</a></li>
                        <li><a href="">显卡</a></li>
                    </ul>
                </div>

                <div class="child">
                    <h3><b></b>办公打印</h3>
                    <ul class="none">
                        <li><a href="">打印机</a></li>
                        <li><a href="">一体机</a></li>
                        <li><a href="">投影机</a></li>
                        </li>
                    </ul>
                </div>

                <div class="child">
                    <h3><b></b>网络产品</h3>
                    <ul class="none">
                        <li><a href="">路由器</a></li>
                        <li><a href="">网卡</a></li>
                        <li><a href="">交换机</a></li>
                        </li>
                    </ul>
                </div>

                <div class="child">
                    <h3><b></b>外设产品</h3>
                    <ul class="none">
                        <li><a href="">鼠标</a></li>
                        <li><a href="">键盘</a></li>
                        <li><a href="">U盘</a></li>
                    </ul>
                </div>
            </div>

            <div style="clear:both; height:1px;"></div>
        </div>
        <!-- 分类列表 end -->



        <!-- 新品推荐 start -->
        <div class="newgoods leftbar mt10">
            <h2><strong>新品推荐</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <?php foreach($status as $new): ?>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=$new->logo?>" alt="" /></a></dt>
                            <dd><a href=""><?=$new->name?></a></dd>
                            <dd><strong>￥<?=$new->shop_price?></strong></dd>
                        </dl>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <!-- 新品推荐 end -->

        <!--热销排行 start -->
        <div class="hotgoods leftbar mt10">
            <h2><strong>热销排行榜</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <li></li>
                </ul>
            </div>
        </div>
        <!--热销排行 end -->

        <!-- 最近浏览 start -->
        <div class="viewd leftbar mt10">
            <h2><a href="">清空</a><strong>最近浏览过的商品</strong></h2>
            <div class="leftbar_wrap">
                <dl>
                    <dt><a href=""><img src="/images/hpG4.jpg" alt="" /></a></dt>
                    <dd><a href="">惠普G4-1332TX 14英寸笔记...</a></dd>
                </dl>

                <dl class="last">
                    <dt><a href=""><img src="/images/crazy4.jpg" alt="" /></a></dt>
                    <dd><a href="">直降200元！TCL正1.5匹空调</a></dd>
                </dl>
            </div>
        </div>
        <!-- 最近浏览 end -->
    </div>
    <!-- 左侧内容 end -->

    <!-- 列表内容 start -->
    <div class="list_bd fl ml10 mt10">
        <!-- 热卖、促销 start -->
        <div class="list_top">
            <!-- 热卖推荐 start -->
            <div class="hotsale fl">
                <h2><strong><span class="none">热卖推荐</span></strong></h2>
                <ul>
                    <?php foreach($goods_status as $status):?>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=$status->logo ?>" alt="" /></a></dt>
                            <dd class="name"><a href=""><?=$status->name ?></a></dd>
                            <dd class="price">特价：<strong>￥<?=$status->shop_price ?></strong></dd>
                            <dd class="buy"><span>立即抢购</span></dd>
                        </dl>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- 热卖推荐 end -->

            <!-- 促销活动 start -->
            <div class="promote fl">
                <h2><strong><span class="none">促销活动</span></strong></h2>
                <ul>
                    <li><b>.</b><a href="">DIY装机之向雷锋同志学习！</a></li>
                    <li><b>.</b><a href="">京东宏碁联合促销送好礼！</a></li>
                    <li><b>.</b><a href="">台式机笔记本三月巨惠！</a></li>
                    <li><b>.</b><a href="">富勒A53g智能人手识别鼠标</a></li>
                    <li><b>.</b><a href="">希捷硬盘白色情人节专场</a></li>
                </ul>

            </div>
            <!-- 促销活动 end -->
        </div>
        <!-- 热卖、促销 end -->

        <div style="clear:both;"></div>

        <!-- 商品筛选 start -->
        <div class="filter mt10">
            <h2><a href="">重置筛选条件</a> <strong>商品筛选</strong></h2>
            <div class="filter_wrap">
                <dl>
                    <dt>品牌：</dt>

                    <dd class="cur"><a href="">不限</a></dd>
                    <?php foreach($brandModel as $brand):?>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','brand'=>$brand->name])?>"><?=$brand->name?></a></dd>
                    <?php endforeach;?>

                </dl>

                <dl>
                    <dt>价格：</dt>
                    <dd class="cur"><a href="">不限</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>1999,'min'=>1000])?>">1000-1999</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>2999,'min'=>2000])?>">2000-2999</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>3000,'min'=>3499])?>">3000-3499</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>3500,'min'=>3999])?>">3500-3999</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>4000,'min'=>4499])?>">4000-4499</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>4500,'min'=>4999])?>">4500-4999</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>5000,'min'=>5999])?>">5000-5999</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>6000,'min'=>6999])?>">6000-6999</a></dd>
                    <dd><a href="<?=\yii\helpers\Url::to(['goods/list','max'=>7000,'min'=>9999])?>">7000-9999</a></dd>
                </dl>

                <dl>
                    <dt>尺寸：</dt>
                    <dd class="cur"><a href="">不限</a></dd>
                    <dd><a href="">10.1英寸及以下</a></dd>
                    <dd><a href="">11英寸</a></dd>
                    <dd><a href="">12英寸</a></dd>
                    <dd><a href="">13英寸</a></dd>
                    <dd><a href="">14英寸</a></dd>
                    <dd><a href="">15英寸</a></dd>
                </dl>

                <dl class="last">
                    <dt>处理器：</dt>
                    <dd class="cur"><a href="">不限</a></dd>
                    <dd><a href="">intel i3</a></dd>
                    <dd><a href="">intel i5</a></dd>
                    <dd><a href="">intel i7</a></dd>
                    <dd><a href="">AMD A6</a></dd>
                    <dd><a href="">AMD A8</a></dd>
                    <dd><a href="">AMD A10</a></dd>
                    <dd><a href="">其它intel平台</a></dd>
                </dl>
            </div>
        </div>
        <!-- 商品筛选 end -->

        <div style="clear:both;"></div>

        <!-- 排序 start -->
        <div class="sort mt10">
            <dl>
                <dt>排序：</dt>
                <dd class="cur"><a href="">销量</a></dd>
                <dd><a href="">价格</a></dd>
                <dd><a href="">评论数</a></dd>
                <dd><a href="">上架时间</a></dd>
            </dl>
        </div>
        <!-- 排序 end -->

        <div style="clear:both;"></div>

        <!-- 商品列表 start-->
        <div class="goodslist mt10">
            <ul>
                <?php foreach($goodsModel as $goods):?>
                <li>
                    <dl>
                        <dt><a href=""><img src="<?=$goods->logo?>" alt="" /></a></dt>
                        <dd><a href=""><?=$goods->name?></a></dt>
                        <dd><strong>￥<?=$goods->shop_price?></strong></dt>
                        <dd><a href=""><em>已有10人评价</em></a></dt>
                    </dl>
                </li>
                 <?php endforeach ;?>


            </ul>
        </div>
        <!-- 商品列表 end-->

        <!-- 分页信息 start -->
        <div class="page mt20">
            <a href="">首页</a>
            <a href="">上一页</a>
            <a href="">1</a>
            <a href="">2</a>
            <a href="" class="cur">3</a>
            <a href="">4</a>
            <a href="">5</a>
            <a href="">下一页</a>
            <a href="">尾页</a>&nbsp;&nbsp;
				<span>
					<em>共8页&nbsp;&nbsp;到第 <input type="text" class="page_num" value="3"/> 页</em>
					<a href="" class="skipsearch" href="javascript:;">确定</a>
				</span>
        </div>
        <!-- 分页信息 end -->

    </div>
    <!-- 列表内容 end -->
</div>
<!-- 列表主体 end-->

<div style="clear:both;"></div>
<!-- 底部导航 start -->

<!-- 底部导航 end -->
<!-- 底部版权 start -->
<?php
use frontend\assets\CommonAsset;
CommonAsset::addCss($this,'@web/style/common.css');
CommonAsset::addCss($this,'@web/style/base.css');
CommonAsset::addCss($this,'@web/style/global.css');
CommonAsset::addCss($this,'@web/style/list.css');
CommonAsset::addScript($this,'@web/js/list.js');
?>
