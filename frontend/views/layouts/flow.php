<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\CommonAsset;
use common\widgets\Alert;
use yii\helpers\Url;

CommonAsset::register($this);
CommonAsset::addCss($this,'@web/style/cart.css');

CommonAsset::addScript($this,'@web/js/cart1.js');
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>

                <li>您好，欢迎来到京西！[
                    <a href="<?php echo Url::to(['member/logout'])?>">  <?php
                        if(Yii::$app->user->isGuest){
                            echo Html::a('请登录',['member/login']);
                        }else{
                            echo Yii::$app->user->identity->username;

                        }
                        ?></a>
                    ] [<a href="<?php echo Url::to(['member/reg'])?>">免费注册</a>] </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>
            </ul>
        </div>
    </div>
    <div style="clear:both;"></div>

    <!-- 页面头部 start -->
    <div class="header w990 bc mt15">
        <div class="logo w990">
            <h2 class="fl"><a href="index.html"><img src="/images/logo.png" alt="京西商城"></a></h2>
            <div class="flow fr">
                <ul>

                    <li class="cur">1.我的购物车</li>
                    <li>2.填写核对订单信息</li>
                    <li>3.成功提交订单</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="mycart w990 mt10 bc">
    <?= $content ?>
</div>
<!-- 主体部分 end -->
<div class="footer w1210 bc mt15">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京西网上商城 版权所有，并保留所有权利。
    </p>
    <p class="auth">
        <a href=""><?=Html::img('@web/images/xin.png')?></a>
        <a href=""><?=Html::img('@web/images/kexin.jpg')?></a>
        <a href=""><?=Html::img('@web/images/police.jpg')?></a>
        <a href=""><?=Html::img('@web/images/beian.gif')?></a>
    </p>
</div>
<!-- 底部版权 end -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
