<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/6
 * Time: 10:14
 */

namespace frontend\controllers;


use frontend\components\CartCookieHandler;
use frontend\models\Cart;
use frontend\models\Goods;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\Request;
use frontend\models\Address;
use frontend\models\Order;
use yii\filters\AccessControl;

class CartController extends Controller
{
//    public $enableCsrfValidation = false;
//
//    public $layout = 'flow';
//
//    public function actionAdd()
//    {
//        $request = new Request();
//        $goods_id = $request->post()["goods_id"];
//        $amount = $request->post()["amount"];
//
//        $model = new Cart();
//        if (!\Yii::$app->user->isGuest) {
//            $cartCookie = new CartCookieHandler();
//            $cartCookie->add($goods_id, $amount)->exec();
//
//
//        } else {
//
//            $model->goods_id = $goods_id;
//            $model->amount = $amount;
//            $model->member_id = \Yii::$app->user->id;
//            $model->save();
//        }
//
//        return $this->redirect('index');
//    }
//
//    public function  actionIndex()
//    {
//        if (!\Yii::$app->user->isGuest) {
//            $cartCookie = new CartCookieHandler();
//            $cart = $cartCookie->all();
//            $model = [];
//            foreach ($cart as $goods_id => $num) {
//                $goods = Goods::findOne(['id' => $goods_id]);
//                $goods->num = $num;
//                $model[] = $goods;
//            }
//        } else {
//            $model = Cart::find()->asArray()->all();
//        }
//
//        return $this->render('index', ['model' => $model]);
//
//
//    }
//
//    public
//    function  actionDelete($id)
//    {
//        $model = Cart::deleteAll(['id' => $id]);
//        if ($model) {
//            echo 'success';
//        }
//    }
    public $layout = 'member';

    public function behaviors()
    {
        return [
            'accessControl'=>[
                'class'=>AccessControl::className(),
                'only'=>['confirm','order'],
                'rules'=>[
                    [
                        'allow'=>true,
                        //'actions'=>['confirm','order'],
                        'roles'=>['@'],
                    ]
                ],
            ]
        ];
    }


    //添加到购物车
    public function actionAddtocart($goods_id,$num)
    {
//        $goods_id = \Yii::$app->request->get('goods_id');
        //判断用户是否登录
        $cartCookie = new CartCookieHandler();
        if(\Yii::$app->user->isGuest){
            //未登录，保存到cookie
            //先从cookie取出购物车数据,cookie保存购物车数据的name==> cart
            /*$cookies = \Yii::$app->request->cookies;
            $cookie = $cookies->get('cart');
            if($cookie == null){
                $cart = [];
            }else{
                $cart = unserialize($cookie->value);
            }*/

            //$cart = [ 'goods_id'=>'num'];
            //['goods_id'=>1,'num'=>2],
            //1=>2
            //];
            //是否存在该商品，如果有，改变数量；没有，添加商品和数量
            /*if(key_exists($goods_id,$cart)){
                $cart[$goods_id] += $num;
            }else{
                $cart[$goods_id]=$num;
            }
            //保存回cookie
            $cookies = \Yii::$app->response->cookies;
            $cookies->add(
                new Cookie([
                    'name'=>'cart',
                    'value'=>serialize($cart),
                    'expire'=>time()+7*24*3600
                ])
            );*/


            $cartCookie->add($goods_id,$num)->exec();

        }else{
            //如果cookie中有购物车数据，合并
            $cartCookie->mergeToTable();
            //已登录将商品保存到购物车数据表
            $cart_goods = Cart::findOne(['goods_id'=>$goods_id]);
            if($cart_goods==null){
                $cart_goods = new Cart();
                $cart_goods->amount = 0;
                $cart_goods->member_id = \Yii::$app->user->id;
                $cart_goods->goods_id = $goods_id;
            }
            $cart_goods->amount += $num;
            $cart_goods->save();
        }


        return $this->redirect(['cart/list']);


    }

    public function actionList()
    {
        //判断用户是否登录
        $cartCookie = new CartCookieHandler();
        if(\Yii::$app->user->isGuest){
            //用户未登录，数据从cookie取出
            /*$cookies = \Yii::$app->request->cookies;
            $cookie = $cookies->get('cart');
            if($cookie == null){
                $cart = [];
            }else{
                $cart = unserialize($cookie->value);
            }*/

            $cart = $cartCookie->all();
            $goodses = [];
            foreach($cart as $goods_id=>$num){
                $goods = Goods::findOne(['id'=>$goods_id]);
                $goods->num = $num;
                $goodses[] = $goods;
            }
        }else{
            //已登录，
            //如果cookie中有购物车数据，合并
            $cartCookie->mergeToTable();
            //从数据表获取购物车数据
            $carts = Cart::findAll(['member_id'=>\Yii::$app->user->id]);
            $goodses = [];
            foreach($carts as $cart){
                $goods = Goods::findOne(['id'=>$cart->goods_id]);
                $goods->num = $cart->amount;
                $goodses[] = $goods;
            }
        }



        return $this->render('list',['goodses'=>$goodses]);

    }
    //确认订单
    public function actionConfirm()
    {
        $model = new Order();
        if(\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

                $model->save();


                return $this->redirect(['cart/order']);
            } else {
                //验证失败
                var_dump($model->getErrors());
                exit;
            }

        }



        return $this->render('confirm',['model'=>$model]);
    }

    //生成订单
    public function actionOrder()
    {

    }

    //处理购物车的ajax请求
    public function actionAjax($type)
    {
        switch($type){
            case 'del':
                    $goods_id = \Yii::$app->request->post('goods_id');
                    //从cookie取出购物车的数据
                    /*$cookies = \Yii::$app->request->cookies;
                    $cookie = $cookies->get('cart');
                    if($cookie == null){
                        $cart = [];
                    }else{
                        $cart = unserialize($cookie->value);
                    }
                    //删除该商品
                    if($goods_id && key_exists($goods_id,$cart)){
                        unset($cart[$goods_id]);
                    }
                    //将购物车数据保存回cookie
                    $cookies = \Yii::$app->response->cookies;
                    $cookies->add(
                        new Cookie([
                            'name'=>'cart',
                            'value'=>serialize($cart),
                            'expire'=>time()+7*24*3600
                        ])
                    );*/
                    $cartCookie = new CartCookieHandler();
                    $cartCookie->del($goods_id)->exec();


                return Json::encode(['status'=>'SUCCESS']);
                break;

        }

    }

}